<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'producto_id', 
        'producto_talle_id', 
        'cantidad', 
        'precio'
    ];

    // Relación para traer los datos de la zapatilla
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Relación para traer el nombre/número del talle
    public function talle()
    {
        return $this->belongsTo(ProductoTalle::class, 'producto_talle_id');
    }
}