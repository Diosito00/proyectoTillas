<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Importamos Auth

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verificamos si el usuario tiene sesión iniciada
        // 2. Verificamos si la columna 'rol' dice 'admin'
        if (Auth::check() && Auth::user()->rol === 'admin') {
            
            // Todo en orden: Lo dejamos pasar a la ruta que solicitó
            return $next($request); 
        }

        // Si es un cliente normal, lo enviamos de vuelta al catálogo con un error
        return redirect('/catalogo')->withErrors(['error' => 'Acceso denegado. Esta área es exclusiva para administradores.']);
    }
}
