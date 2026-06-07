<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;

class ContactoController extends Controller
{
    public function store(Request $request)
    {
        // Validamos que no envíen campos vacíos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string',
        ]);

        // Guardamos en MariaDB
        Contacto::create($request->all());

        // Devolvemos al usuario a la misma página con un mensaje de éxito
        return back()->with('success', '¡Gracias por escribirnos! Tu mensaje fue enviado y te responderemos pronto.');
    }
}