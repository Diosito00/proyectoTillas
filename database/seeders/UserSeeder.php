<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Creamos el Usuario Administrador
        User::create([
            'name' => 'Admin Tillas',
            'email' => 'admin@tillas.com',
            'password' => Hash::make('admin123'), // Contraseña por defecto
            'rol' => 'admin',
        ]);

        // 2. Creamos un Usuario Cliente de prueba
        User::create([
            'name' => 'Cliente Prueba',
            'email' => 'cliente@tillas.com',
            'password' => Hash::make('cliente123'), // Contraseña por defecto
            'rol' => 'cliente',
        ]);
    }
}