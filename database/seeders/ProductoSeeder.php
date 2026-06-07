<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Vaciamos la tabla antes de cargar para evitar duplicados si se corre dos veces
        // Nota: Si tenés restricciones de clave foránea activas, podés usar Producto::query()->delete();
        Producto::query()->delete();

        $productos = [
            [
                'marca' => 'Puma',
                'nombre' => 'Puma Velocity Nitro 3',
                'precio' => 125000,
                'imagen_url' => 'Puma-v-n-3.jpg',
                'categoria' => 'mujer',
                'deporte_uso' => 'running',
                'descripcion' => 'Zapatilla de running de máxima amortiguación y confort.'
            ],
            [
                'marca' => 'Puma',
                'nombre' => 'Puma x Salehe Bembury',
                'precio' => 145000,
                'imagen_url' => 'Puma-Salehe-b-v-n-u.jpg',
                'categoria' => 'unisex',
                'deporte_uso' => 'urbano',
                'descripcion' => 'Edición especial urbana con diseño vanguardista.'
            ],
            [
                'marca' => 'Topper',
                'nombre' => 'Topper Core Mesh',
                'precio' => 180000,
                'imagen_url' => 'Topper-c-m.jpg',
                'categoria' => 'hombre',
                'deporte_uso' => 'entrenamiento',
                'descripcion' => 'Calzado liviano ideal para rutinas de gimnasio.'
            ],
            [
                'marca' => 'Topper',
                'nombre' => 'Topper Fast 2.0',
                'precio' => 160000,
                'imagen_url' => 'Topper-f-2.jpg',
                'categoria' => 'hombre',
                'deporte_uso' => 'running',
                'descripcion' => 'Zapatilla aerodinámica para entrenamiento diario.'
            ],
            [
                'marca' => 'Topper',
                'nombre' => 'Topper Terre Kids',
                'precio' => 86700,
                'imagen_url' => 'Topper-t-k.jpg',
                'categoria' => 'nino',
                'deporte_uso' => 'urbano',
                'descripcion' => 'Calzado urbano resistente para niños.'
            ],
            [
                'marca' => 'Topper',
                'nombre' => 'Topper Terre Mid',
                'precio' => 87500,
                'imagen_url' => 'Topper-t-m.jpg',
                'categoria' => 'nino',
                'deporte_uso' => 'urbano',
                'descripcion' => 'Zapatilla de caña media cómoda y moderna.'
            ],
            [
                'marca' => 'Topper',
                'nombre' => 'Topper Mamba II Kids',
                'precio' => 77999,
                'imagen_url' => 'Topper-m-ii-k.jpg',
                'categoria' => 'nino',
                'deporte_uso' => 'entrenamiento',
                'descripcion' => 'Deportiva versátil para actividades escolares y juegos.'
            ],
            [
                'marca' => 'Topper',
                'nombre' => 'Topper Zurich III',
                'precio' => 85999,
                'imagen_url' => 'Topper-z-iii.jpg',
                'categoria' => 'nino',
                'deporte_uso' => 'running',
                'descripcion' => 'Running liviano adaptado para los más chicos.'
            ],
            [
                'marca' => 'Topper',
                'nombre' => 'Topper Graft Metalic',
                'precio' => 105000,
                'imagen_url' => 'Topper-g-m.jpg',
                'categoria' => 'mujer',
                'deporte_uso' => 'urbano',
                'descripcion' => 'Estilo urbano con detalles metalizados en tendencia.'
            ],
            [
                'marca' => 'Topper',
                'nombre' => 'Topper Hyde II Max',
                'precio' => 79999,
                'imagen_url' => 'Topper-h-ii-m-p.jpg',
                'categoria' => 'mujer',
                'deporte_uso' => 'urbano',
                'descripcion' => 'Zapatilla clásica de uso diario con plataforma cómoda.'
            ],
            [
                'marca' => 'Puma',
                'nombre' => 'Puma Solar',
                'precio' => 149999,
                'imagen_url' => 'Puma-s.jpg',
                'categoria' => 'mujer',
                'deporte_uso' => 'entrenamiento',
                'descripcion' => 'Zapatilla deportiva de alta performance para entrenamiento.'
            ]
        ];

        foreach ($productos as $info) {
            Producto::create($info);
        }
    }
}
