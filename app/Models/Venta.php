<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['user_id', 'total', 'direccion', 'fecha'];

    // Relación: Una venta tiene muchos detalles
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}