<?php

namespace Database\Seeders;

# use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\ProductoTalle;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // ZAPATILLA 1: Puma Velocity Nitro 3
        // ==========================================
        $p1 = Producto::create([
            'nombre'      => 'Puma Velocity Nitro 3',
            'descripcion' => 'Zapatillas de running con excelente amortiguación y respuesta para entrenamientos diarios.',
            'marca'       => 'puma', // En minúscula para que coincida con tus filtros HTML
            'categoria'   => 'hombre',
            'deporte_uso' => 'running',
            'precio'      => 125000.00,
            'imagen_url'  => 'Puma-v-n-3.jpg' // El nombre de la foto que ya tenías
        ]);

        // Le asignamos talles y stock a la Puma
        ProductoTalle::create(['producto_id' => $p1->id, 'talle' => 40, 'stock' => 5]);
        ProductoTalle::create(['producto_id' => $p1->id, 'talle' => 41, 'stock' => 12]);
        ProductoTalle::create(['producto_id' => $p1->id, 'talle' => 42, 'stock' => 0]); // Agotado a propósito para probar

        // ==========================================
        // ZAPATILLA 2: Topper Fast 2.0
        // ==========================================
        $p2 = Producto::create([
            'nombre'      => 'Topper Fast 2.0',
            'descripcion' => 'Calzado urbano ideal para el uso diario, cómodo y ligero.',
            'marca'       => 'topper',
            'categoria'   => 'mujer',
            'deporte_uso' => 'urbano',
            'precio'      => 160000.00,
            'imagen_url'  => 'Topper-f-2.jpg'
        ]);

        // Le asignamos talles y stock a la Topper
        ProductoTalle::create(['producto_id' => $p2->id, 'talle' => 37, 'stock' => 8]);
        ProductoTalle::create(['producto_id' => $p2->id, 'talle' => 38, 'stock' => 3]);
    }
}
