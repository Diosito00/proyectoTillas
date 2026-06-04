<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


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
////////////////////////////////////////


    // 1. Muestra la vista del formulario de registro
public function showRegisterForm()
{
    return view('registro');
}

// 2. Procesa y valida los datos del nuevo cliente
public function register(Request $request)
{
    // VALIDACIÓN EXIGIDA POR LA CONSIGNA
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users', // 'unique' evita correos duplicados
        'password' => 'required|string|min:6|confirmed', // 'confirmed' exige que coincida con password_confirmation
    ], [
        // Mensajes personalizados en español si querés lucirte
        'email.unique' => 'Este correo electrónico ya está registrado.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
    ]);

    // CREACIÓN DEL USUARIO EN MARIADB
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Encriptación obligatoria
        'rol' => 'cliente', // Por defecto, todos se registran con el rol básico
    ]);

    // Logueamos automáticamente al cliente recién creado
    Auth::login($user);

    // Redirigimos al catálogo con un mensaje de bienvenida
    return redirect()->route('catalogo')->with('success', '¡Cuenta creada con éxito! Bienvenido a Tillas.');
}
}



