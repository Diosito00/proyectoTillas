<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoTalle extends Model
{
    use HasFactory;

    // 1. Campos que permitimos llenar
    protected $fillable = [
        'producto_id',
        'talle',
        'stock',
    ];

    // 2. Definimos la relación: Un talle PERTENECE a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}