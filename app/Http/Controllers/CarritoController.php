<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Producto;
use App\Models\ProductoTalle;


class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        // 1. Validamos que nos envíen la información correcta
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'talle_id' => 'required|exists:producto_talles,id',
        ]);

        // 2. Buscamos la zapatilla en la base de datos para obtener su precio y nombre
        $producto = Producto::findOrFail($request->producto_id);
        $talle = ProductoTalle::findOrFail($request->talle_id);

        // 3. Obtenemos el carrito actual de la sesión (o creamos un arreglo vacío si es la primera vez)
        $carrito = session()->get('carrito', []);

        // Creamos una clave única para este ítem (mezclando ID de producto y ID de talle)
        // Así diferenciamos si compran la misma zapatilla pero en talle 40 y 41
        $id_unico = $producto->id . '-' . $talle->id;

        // 4. Lógica de guardado
        if (isset($carrito[$id_unico])) {
            // Si ya tenía esta zapatilla en este talle exacto, le sumamos 1 a la cantidad
            $carrito[$id_unico]['cantidad']++;
        } else {
            // Si es nueva, la agregamos al arreglo
            $carrito[$id_unico] = [
                'producto_id' => $producto->id,
                'nombre' => $producto->nombre,
                'talle' => $talle->talle,
                'precio' => $producto->precio,
                'imagen' => $producto->imagen_url,
                'cantidad' => 1
            ];
        }

        // 5. Guardamos el arreglo actualizado nuevamente en la sesión
        session()->put('carrito', $carrito);

        // 6. Lo devolvemos a la página anterior con un mensaje de éxito
        return back()->with('success', '¡Zapatillas agregadas al carrito exitosamente!');
    }

    public function index()
    {
        // 1. Recuperamos el carrito de la sesión (o un array vacío si no hay nada)
        $carrito = session()->get('carrito', []);

        // 2. Calculamos el total sumando (precio * cantidad) de cada zapatilla
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // 3. Enviamos los datos a la nueva vista
        return view('carrito', compact('carrito', 'total'));
    }

    public function eliminar(Request $request)
    {
        // 1. Validamos que nos envíen el ID único (ej: "1-40")
        $request->validate([
            'id_unico' => 'required'
        ]);

        // 2. Traemos el carrito actual
        $carrito = session()->get('carrito', []);

        // 3. Verificamos si ese ID realmente existe en la sesión
        if (isset($carrito[$request->id_unico])) {
            
            // Lo eliminamos del arreglo
            unset($carrito[$request->id_unico]);
            
            // Guardamos el arreglo limpio de vuelta en la sesión
            session()->put('carrito', $carrito);
            
            return back()->with('success', 'Producto eliminado correctamente.');
        }

        return back()->withErrors(['error' => 'No se pudo eliminar el producto.']);
    }

    public function procesarCompra()
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return back()->withErrors(['error' => 'Tu carrito está vacío.']);
        }

        // Calculamos el total nuevamente por seguridad
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // Iniciamos la Transacción: Si algo falla acá adentro, Laravel deshace todo.
        DB::beginTransaction();

        try {
            // 1. Creamos el ticket general (Pedido)
            $pedido = Pedido::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'estado' => 'aprobado'
            ]);

            // 2. Procesamos cada zapatilla del carrito
            foreach ($carrito as $id_unico => $item) {
                // Separamos el ID del producto y el ID del talle (que venían como "1-40")
                $partes = explode('-', $id_unico);
                $producto_id = $partes[0];
                $talle_id = $partes[1];

                // 3. Verificamos el stock real en la base de datos
                $talleDB = ProductoTalle::findOrFail($talle_id);
                
                if ($talleDB->stock < $item['cantidad']) {
                    // Si justo alguien más compró el último par, cancelamos todo el proceso
                    throw new \Exception('No hay stock suficiente para ' . $item['nombre'] . ' en talle ' . $item['talle']);
                }

                // 4. Guardamos el renglón del detalle
                PedidoDetalle::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto_id,
                    'producto_talle_id' => $talle_id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio']
                ]);

                // 5. RESTAMOS EL STOCK de la base de datos
                $talleDB->stock -= $item['cantidad'];
                $talleDB->save();
            }

            // Si llegamos hasta acá sin errores, confirmamos la operación en MariaDB
            DB::commit();

            // Vaciamos la memoria del carrito
            session()->forget('carrito');

            return redirect()->route('catalogo')->with('success', '¡Compra realizada con éxito! Tu pedido está siendo preparado.');

        } catch (\Exception $e) {
            // Si hubo un error (ej. falta de stock), deshacemos todo
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}