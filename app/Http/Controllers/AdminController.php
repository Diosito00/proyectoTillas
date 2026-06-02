<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Importamos el modelo

class AdminController extends Controller
{
    public function index()
    {
        // Traemos todos los productos ordenados por el más nuevo primero
        $productos = Producto::orderBy('created_at', 'desc')->paginate(10);
        
        // Retornamos una vista nueva (que crearemos en el paso 3)
        return view('admin.index', compact('productos'));
    }

    // Muestra el formulario
    public function create()
    {
        return view('admin.create');
    }

    // Procesa el guardado en la base de datos
    public function store(Request $request)
    {
        // 1. Validamos que el administrador envíe todo correctamente
        $request->validate([
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'categoria' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Máximo 2MB
        ]);

        // 2. Procesamos la subida de la imagen
        $nombreImagen = null;
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            // Le ponemos un nombre único basado en el tiempo exacto para que no se sobreescriban
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            // Movemos la imagen a tu carpeta public/imagenes
            $archivo->move(public_path('imagenes'), $nombreImagen);
        }

        // 3. Guardamos el producto en MariaDB
        Producto::create([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'categoria' => $request->categoria,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagen_url' => $nombreImagen,
        ]);

        // 4. Volvemos al panel con un mensaje de éxito
        return redirect()->route('admin.index')->with('success', '¡Zapatilla agregada al inventario exitosamente!');
    }
}