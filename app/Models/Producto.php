<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // 1. Campos que permitimos llenar de forma masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'marca',
        'categoria',
        'deporte_uso',
        'precio',
        'imagen_url',
    ];

    // 2. Definimos la relación: Un producto tiene MUCHOS talles (1:N)
    public function talles()
    {
        return $this->hasMany(ProductoTalle::class);
    }
}