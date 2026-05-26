<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'user_id', 
        'total', 
        'estado'
    ];

    // Un pedido tiene muchos detalles (renglones)
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class);
    }
}