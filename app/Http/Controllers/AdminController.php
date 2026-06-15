<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Producto; // Importamos el modelo
use App\Models\ProductoTalle;
use App\Models\Contacto;
use App\Models\Venta;

class AdminController extends Controller
{
    // Carga el Tablero de Control (Dashboard)
    public function index()
    {
        // 1. Calculamos los KPIs (Indicadores Clave)
        $totalVentas = Venta::sum('total'); // Suma todo el dinero ingresado
        $totalProductos = Producto::count(); // Zapatillas en catálogo
        $totalUsuarios = User::where('rol', 'cliente')->count(); // Solo cuenta a los clientes
        
        // Alertas: Contamos cuántos talles tienen 5 o menos pares en stock
        $alertasStock = ProductoTalle::where('stock', '<=', 5)->count();

        // 2. Traemos la actividad reciente (solo los últimos 5 registros)
        $ultimasVentas = Venta::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        $ultimosMensajes = Contacto::orderBy('created_at', 'desc')->take(5)->get();

        // Enviamos todo a la vista
        return view('admin.index', compact(
            'totalVentas', 'totalProductos', 'totalUsuarios', 'alertasStock',
            'ultimasVentas', 'ultimosMensajes'
        ));
    }

    // Carga la tabla completa del inventario
    public function inventario()
    {
        // Traemos todos los productos ordenados por los más recientes
        $productos = Producto::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.inventario', compact('productos'));
    }

    // Muestra el formulario
    public function create()
    {
        return view('admin.create');
    }

    // Procesa el guardado en la base de datos
    public function store(Request $request)
    {
        // 1. Validamos (Agregamos deporte_uso)
        $request->validate([
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'categoria' => 'required|string',
            'deporte_uso' => 'nullable|string|max:255', // <-- NUEVO CAMPO
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Procesamos la subida de la imagen
        $nombreImagen = null;
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('imagenes'), $nombreImagen);
        }

        // 3. Guardamos el producto en MariaDB (Agregamos deporte_uso)
        Producto::create([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'categoria' => $request->categoria,
            'deporte_uso' => $request->deporte_uso, // <-- NUEVO CAMPO
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagen_url' => $nombreImagen,
        ]);

        return redirect()->route('admin.inventario')->with('success', '¡Zapatilla agregada al inventario exitosamente!');
    }

    // Muestra la vista de gestión de stock para una zapatilla
    public function talles($id)
    {
        $producto = Producto::findOrFail($id);
        $talles = ProductoTalle::where('producto_id', $id)->orderBy('talle', 'asc')->get();
        
        return view('admin.talles', compact('producto', 'talles'));
    }

    // Procesa la carga de nuevo stock
    public function guardarTalle(Request $request, $id)
    {
        $request->validate([
            'talle' => 'required|numeric',
            'stock' => 'required|integer|min:1',
        ]);

        // Buscamos si ese talle ya existe en esta zapatilla
        $talleExistente = ProductoTalle::where('producto_id', $id)
                                        ->where('talle', $request->talle)
                                        ->first();

        if ($talleExistente) {
            // Si existe, le SUMAMOS la cantidad nueva al stock actual
            $talleExistente->stock += $request->stock;
            $talleExistente->save();
            $mensaje = 'Stock sumado correctamente al talle ' . $request->talle;
        } else {
            // Si no existe, creamos el registro
            ProductoTalle::create([
                'producto_id' => $id,
                'talle' => $request->talle,
                'stock' => $request->stock,
            ]);
            $mensaje = 'Nuevo talle ' . $request->talle . ' agregado correctamente.';
        }

        return back()->with('success', $mensaje);
    }

    // Mostrar el formulario con los datos cargados
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.edit', compact('producto'));
    }

    // Procesar la Modificación
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'categoria' => 'required|string',
            'deporte_uso' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        $nombreImagen = $producto->imagen_url; 

        // Si sube una FOTO NUEVA, reemplazamos la anterior físicamente
        if ($request->hasFile('imagen')) {
            if ($nombreImagen && File::exists(public_path('imagenes/' . $nombreImagen))) {
                File::delete(public_path('imagenes/' . $nombreImagen));
            }
            $archivo = $request->file('imagen');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('imagenes'), $nombreImagen);
        }

        $producto->update([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'categoria' => $request->categoria,
            'deporte_uso' => $request->deporte_uso,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagen_url' => $nombreImagen,
        ]);

        return redirect()->route('admin.inventario')->with('success', '¡Modificación realizada correctamente!');
    }

    // Procesar la Baja Lógica
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        // ATENCIÓN: No usamos File::delete() aquí. 
        // Como es una baja lógica, la foto y el registro deben quedar en el servidor.
        
        $producto->delete(); // Esto llenará la columna 'deleted_at'
        
        return back()->with('success', 'Producto dado de baja exitosamente (Baja Lógica).');
    }

    // Mostrar el listado de usuarios registrados
    public function usuarios()
    {
        // Paginamos de a 10 para no saturar la pantalla si tienes cientos de clientes
        $usuarios = User::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.usuarios', compact('usuarios'));
    }

    // Mostrar el formulario de creación de usuario admin
    public function createUsuario()
    {
        return view('admin.crear-usuario');
    }

    // Guardar el nuevo administrador en MariaDB
    public function storeUsuario(Request $request)
    {
        // Validamos los datos (el email debe ser único en la tabla 'users')
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Reclama un campo 'password_confirmation'
        ]);

        // Creamos el usuario forzando el rol como 'admin'
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->rol = 'admin'; // Asignación directa y segura saltando el $fillable
        $usuario->save(); // Guardamos en MariaDB

        return redirect()->route('admin.usuarios')->with('success', '¡Nuevo usuario administrador creado con éxito!');
    }

    // Actualizar el rol de un usuario (Admin <-> Cliente)
    public function updateRol(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'rol' => 'required|in:admin,cliente',
        ]);

        // PROTECCIÓN: Evitar que el administrador activo se quite sus propios permisos
        if ($usuario->id === auth()->id() && $request->rol === 'cliente') {
            return back()->withErrors(['error' => 'Por seguridad, no puedes quitarte tus propios permisos de administrador.']);
        }

        $usuario->rol = $request->rol;
        $usuario->save();

        return back()->with('success', 'El rol de ' . $usuario->name . ' ha sido actualizado a ' . strtoupper($request->rol) . '.');
    }

    // Mostrar la bandeja de entrada de consultas
    public function mensajes()
    {
        // Traemos los mensajes ordenados por el más reciente
        $mensajes = Contacto::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.mensajes', compact('mensajes'));
    }

    // Eliminar un mensaje de la bandeja de entrada
    public function destroyMensaje($id)
    {
        $mensaje = Contacto::findOrFail($id);
        $mensaje->delete();

        return back()->with('success', 'El mensaje ha sido eliminado de la bandeja de entrada.');
    }

    // Mostrar el historial de ventas del e-commerce
    public function ventas()
    {
        // Traemos los pedidos ordenados por el más reciente
        $ventas = Venta::with('user')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.ventas', compact('ventas'));
    }
}