<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // La clase mágica de Laravel para seguridad

class AuthController extends Controller
{
    // 1. Mostrar el formulario de Login
    public function showLoginForm()
    {
        return view('login'); 
    }

    // 2. Procesar el intento de inicio de sesión
    public function login(Request $request)
    {
        // Validamos que envíe email y contraseña
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentamos loguearlo de verdad contra MariaDB
        if (Auth::attempt($credentials)) {
            // Éxito: Regeneramos la sesión por seguridad y lo mandamos al catálogo
            $request->session()->regenerate();
            return redirect()->intended('/catalogo');
        }

        // Falla: Lo devolvemos al login con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // 3. Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
