<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CatalogoController extends Controller
{
    // Inyectamos la variable $request para poder leer la URL (los $_GET)
    public function index(Request $request)
    {
        // 1. Iniciamos la consulta (Preparamos el motor, pero aún no traemos los datos)
        $query = Producto::query();

        // 2. Filtro por Categorías (Hombre, Mujer, Niño)
        if ($request->has('categorias')) {
            // whereIn busca que la columna coincida con CUALQUIERA de los valores del array
            $query->whereIn('categoria', $request->categorias);
        }

        // 3. Filtro por Deportes / Uso
        if ($request->has('deportes')) {
            $query->whereIn('deporte_uso', $request->deportes);
        }

        // 4. Filtro por Marcas
        if ($request->has('marcas')) {
            $query->whereIn('marca', $request->marcas);
        }

        // 5. Sistema de Ordenamiento
        if ($request->has('ordenarPor')) {
            switch ($request->ordenarPor) {
                case 'menor_precio':
                    $query->orderBy('precio', 'asc'); // Ascendente: de barato a caro
                    break;
                case 'mayor_precio':
                    $query->orderBy('precio', 'desc'); // Descendente: de caro a barato
                    break;
                case 'recientes':
                    $query->orderBy('created_at', 'desc'); // Los más nuevos primero
                    break;
            }
        } else {
            // Orden por defecto si el usuario acaba de entrar a la página y no eligió nada
            $query->orderBy('created_at', 'desc'); 
        }

        // 6. Ejecutamos la consulta final y paginamos.
        // OJO a withQueryString(): Esto es VITAL para que al pasar a la página 2 
        // no se borren los filtros que el usuario había seleccionado.
        $productos = $query->paginate(9)->withQueryString();

        // 7. Enviamos los resultados a tu vista
        return view('catalogo', compact('productos'));
    }

    public function show($id)
    {
        // findOrFail buscará el ID. Si alguien escribe /producto/999 y no existe, 
        // Laravel mostrará automáticamente una página de error 404.
        $producto = Producto::with('talles')->findOrFail($id);

        return view('producto', compact('producto'));
    }
}