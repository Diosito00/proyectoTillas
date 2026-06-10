<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\ProductoTalle;
use App\Models\Venta;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        // 1. Validamos que nos envíen la información correcta (captura cantidad solicitada)
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'talle_id'    => 'required|exists:producto_talles,id',
            'cantidad'    => 'required|integer|min:1'
        ]);

        // 2. Buscamos la zapatilla y el talle en la base de datos
        $producto = Producto::findOrFail($request->producto_id);
        $talle = ProductoTalle::findOrFail($request->talle_id);

        if ($request->cantidad > $talle->stock) {
            return back()->withErrors([
                'error' => "No podés agregar {$request->cantidad} pares. El talle {$talle->talle} solo tiene {$talle->stock} pares en stock."
            ]);
        }

        // 3. Obtenemos el carrito actual de la sesión
        $carrito = session()->get('carrito', []);

        // Usamos una clave compuesta (ID_PRODUCTO-ID_TALLES_PIVOT)
        $id_unico = $producto->id . '-' . $talle->id;

        // 4. Lógica de guardado considerando la cantidad enviada por el cliente
        if (isset($carrito[$id_unico])) {
            // Validamos que la suma acumulada tampoco supere el stock real
            if (($carrito[$id_unico]['cantidad'] + $request->cantidad) > $talle->stock) {
                return back()->withErrors(['error' => "Ya tenés unidades en el carrito. No podés superar el stock máximo de {$talle->stock} pares."]);
            }
            $carrito[$id_unico]['cantidad'] += $request->cantidad; // <-- SOLUCIÓN: Suma la cantidad solicitada
        } else {
            $carrito[$id_unico] = [
                'producto_id'     => $producto->id,
                'producto_talle_id' => $talle->id, // Guardamos este ID para facilitar el descuento de stock luego
                'nombre'          => $producto->nombre,
                'talle'           => $talle->talle,
                'precio'          => $producto->precio,
                'imagen'          => $producto->imagen_url,
                'cantidad'        => $request->get('cantidad') // <-- SOLUCIÓN: Guarda la cantidad exacta elegida
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('success', '¡Zapatillas agregadas al carrito exitosamente!');
    }

    public function index()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('carrito', compact('carrito', 'total'));
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id_unico' => 'required'
        ]);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$request->id_unico])) {
            unset($carrito[$request->id_unico]);
            session()->put('carrito', $carrito);
            
            return back()->with('success', 'Producto eliminado correctamente.');
        }

        return back()->withErrors(['error' => 'No se pudo eliminar el producto.']);
    }

    public function mostrarCheckout()
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('catalogo')->withErrors(['error' => 'Tu carrito está vacío.']);
        }

        $total = 0;
        foreach($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('checkout', compact('carrito', 'total'));
    }

    public function procesarCompra(Request $request)
    {
        $carrito = session()->get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('catalogo');
        }

        $request->validate([
            'direccion' => 'required|string|max:255',
            'telefono'  => 'required|string|max:20',
        ]);

        $total = 0;
        foreach($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        
        // Usamos una Transacción de Base de Datos por seguridad (Database Transaction)
        // Si la inserción del detalle falla o el stock no se descuenta, MariaDB cancela todo automáticamente
        DB::beginTransaction();

        try {
            // 1. CABECERA: Registra la venta en la tabla 'ventas'
            $venta = Venta::create([
                'user_id'   => Auth::id(),
                'total'     => $total,
                'direccion' => $request->direccion, 
                'fecha'     => now(),
            ]);

            // 2. DETALLES Y REDUCCIÓN DE STOCK
            foreach ($carrito as $key => $item) {
                
                $partes = explode('-', $key);
                $talleId = isset($partes[1]) ? $partes[1] : ($item['producto_talle_id'] ?? null);
                $cantidadComprada = $item['cantidad'];

                // A. Inserción en la tabla de detalles relacional
                DB::table('detalle_ventas')->insert([
                    'venta_id'        => $venta->id,
                    'producto_id'     => $item['producto_id'],
                    'talle'           => $item['talle'], 
                    'cantidad'        => $cantidadComprada, // <-- SOLUCIÓN: Inserta la cantidad real del carrito
                    'precio_unitario' => $item['precio'],
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);

                // B. NUEVO Y CRÍTICAL: Reducir el stock físico en MariaDB
                if ($talleId) {
                    DB::table('producto_talles')
                        ->where('id', $talleId)
                        ->decrement('stock', $cantidadComprada); // <-- SOLUCIÓN: Descuenta la cantidad exacta
                }
            }

            // Si todo salió bien, confirmamos los cambios en MariaDB
            DB::commit();

            // Libera la sesión de memoria
            session()->forget('carrito');

            return redirect()->route('compras.historial')->with('success', '¡Compra realizada con éxito! Podés verla en tu historial.');

        } catch (\Exception $e) {
            // Si algo falla en el proceso, deshacemos todo para evitar inconsistencias en el dinero o inventario
            DB::rollBack();
            return back()->withErrors(['error' => 'Ocurrió un error crítico al procesar la transacción: ' . $e->getMessage()]);
        }
    }

    public function historial()
    {
        $compras = Venta::where('user_id', auth()->id())
                        ->with('detalles.producto') 
                        ->orderBy('fecha', 'desc') 
                        ->get();

        return view('historial', compact('compras'));
    }

    public function verFactura($id)
    {
        $venta = Venta::with('detalles.producto')->findOrFail($id);

        if ($venta->user_id !== auth()->id()) {
            abort(403, 'Acceso no autorizado a este comprobante.');
        }

        return view('factura', compact('venta'));
    }
}