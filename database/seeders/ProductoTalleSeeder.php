<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\ProductoTalle; // Importamos el modelo de la tabla pivot

class ProductoTalleSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiamos la tabla por si corremos el seeder varias veces
        ProductoTalle::query()->delete();

        // Traemos las 11 zapatillas que cargamos recién
        $productos = Producto::all();

        foreach ($productos as $producto) {
            
            // Definimos qué talles fabricar según la categoría de la zapatilla
            if ($producto->categoria === 'nino') {
                $talles = [28, 30, 32, 34];
            } elseif ($producto->categoria === 'mujer') {
                $talles = [36, 37, 38, 39, 40];
            } else { 
                // Para hombre y unisex
                $talles = [39, 40, 41, 42, 43, 44];
            }

            // Guardamos cada talle en la base de datos con un stock aleatorio
            foreach ($talles as $talle) {
                ProductoTalle::create([
                    'producto_id' => $producto->id,
                    'talle'       => $talle,
                    'stock'       => rand(5, 15), // Asigna entre 5 y 15 pares disponibles
                ]);
            }
        }
    }
}
