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


    /**
     * Muestra la vista del formulario de registro.
     * Retorna el archivo Blade donde el visitante ingresa sus datos para crear una cuenta.
     */
public function showRegisterForm()
{
    return view('registro');
}
/**
     * Procesa, valida y da de alta los datos del nuevo cliente en la base de datos.
     * Si pasa los filtros, lo loguea de forma automática y lo redirige al catálogo.
     */
public function register(Request $request)
{
   // VALIDACIÓN DE REGLAS: Filtra los datos del formulario antes de tocar MariaDB
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users', // 'unique' evita correos duplicados
        'password' => 'required|string|min:6|confirmed', // 'confirmed' exige que coincida con password_confirmation
    ], [
       // Mensajes personalizados en español para mejorar la experiencia de usuario
        'email.unique' => 'Este correo electrónico ya está registrado.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
    ]);

    /// PERSISTENCIA: Crea el nuevo registro en la tabla 'users' utilizando asignación masiva
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Encriptación obligatoria
        'rol' => 'cliente', // Por defecto, todos se registran con el rol básico
    ]);

    // AUTENTICACIÓN: Inicia la sesión en el navegador de manera automática para el cliente creado
    Auth::login($user);

    // Redirigimos al catálogo con un mensaje de bienvenida
    return redirect()->route('catalogo')->with('success', '¡Cuenta creada con éxito! Bienvenido a Tillas.');
}
}



