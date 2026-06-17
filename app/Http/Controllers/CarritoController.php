<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\ProductoTalle;
use App\Models\Venta;
use App\Models\Carrito;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'talle_id'    => 'required|exists:producto_talles,id',
            'cantidad'    => 'required|integer|min:1'
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        $talle = ProductoTalle::findOrFail($request->talle_id);

        if ($request->cantidad > $talle->stock) {
            return back()->withErrors(['error' => "El talle {$talle->talle} solo tiene {$talle->stock} pares en stock."]);
        }

        // Buscamos si este usuario ya tiene ESTE talle exacto en su carrito en la BD
        $itemCarrito = Carrito::where('user_id', Auth::id())
                              ->where('producto_talle_id', $talle->id)
                              ->first();

        if ($itemCarrito) {
            // Si ya lo tiene, le sumamos la cantidad (verificando stock límite)
            if (($itemCarrito->cantidad + $request->cantidad) > $talle->stock) {
                return back()->withErrors(['error' => "Con lo que ya tenés en el carrito, superás el stock máximo de {$talle->stock} pares."]);
            }
            $itemCarrito->cantidad += $request->cantidad;
            $itemCarrito->save();
        } else {
            // Si no lo tiene, creamos un nuevo registro en la BD
            Carrito::create([
                'user_id'           => Auth::id(),
                'producto_id'       => $producto->id,
                'producto_talle_id' => $talle->id,
                'cantidad'          => $request->cantidad,
                'precio'            => $producto->precio
            ]);
        }

        return back()->with('success', '¡Zapatillas agregadas al carrito!');
    }

    public function index()
    {
        // Traemos el carrito directo de la BD con sus relaciones
        $carrito = Carrito::with(['producto', 'talle'])->where('user_id', Auth::id())->get();
        
        $total = $carrito->sum(function($item) {
            return $item->precio * $item->cantidad;
        });

        return view('carrito', compact('carrito', 'total'));
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'carrito_id' => 'required|exists:carritos,id', // Ahora usamos el ID real de la tabla
            'cantidad'   => 'required|integer|min:1'
        ]);

        $item = Carrito::where('id', $request->carrito_id)->where('user_id', Auth::id())->firstOrFail();
        $talle = ProductoTalle::findOrFail($item->producto_talle_id);

        if ($request->cantidad > $talle->stock) {
            return back()->withErrors(['error' => "Solo nos quedan {$talle->stock} pares en talle {$talle->talle}."]);
        }

        $item->cantidad = $request->cantidad;
        $item->save();

        return back()->with('success', 'Cantidad actualizada correctamente.');
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'carrito_id' => 'required|exists:carritos,id'
        ]);

        Carrito::where('id', $request->carrito_id)->where('user_id', Auth::id())->delete();
        
        return back()->with('success', 'Producto eliminado correctamente.');
    }

    public function mostrarCheckout()
    {
        $carrito = Carrito::with(['producto', 'talle'])->where('user_id', Auth::id())->get();

        if ($carrito->isEmpty()) {
            return redirect()->route('catalogo')->withErrors(['error' => 'Tu carrito está vacío.']);
        }

        $total = $carrito->sum(function($item) {
            return $item->precio * $item->cantidad;
        });

        return view('checkout', compact('carrito', 'total'));
    }

    public function procesarCompra(Request $request)
    {
        $carrito = Carrito::where('user_id', Auth::id())->get();
        
        if ($carrito->isEmpty()) {
            return redirect()->route('catalogo');
        }

        $request->validate([
            'direccion' => 'required|string|max:255',
            'telefono'  => 'required|string|max:20',
        ]);

        $total = $carrito->sum(function($item) {
            return $item->precio * $item->cantidad;
        });
        
        DB::beginTransaction();

        try {
            $venta = Venta::create([
                'user_id'   => Auth::id(),
                'total'     => $total,
                'direccion' => $request->direccion, 
                'fecha'     => now(),
            ]);

            foreach ($carrito as $item) {
                DB::table('detalle_ventas')->insert([
                    'venta_id'        => $venta->id,
                    'producto_id'     => $item->producto_id,
                    'talle'           => $item->talle->talle, // Sacamos el número de talle de la relación
                    'cantidad'        => $item->cantidad,
                    'precio_unitario' => $item->precio,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);

                // Descontamos stock
                DB::table('producto_talles')
                    ->where('id', $item->producto_talle_id)
                    ->decrement('stock', $item->cantidad);
            }

            // Vaciamos el carrito de este usuario eliminando sus registros de la BD
            Carrito::where('user_id', Auth::id())->delete();

            DB::commit();
            return redirect()->route('compras.historial')->with('success', '¡Compra realizada con éxito! Podés verla en tu historial.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Ocurrió un error al procesar la compra: ' . $e->getMessage()]);
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