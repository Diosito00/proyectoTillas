<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    protected $fillable = [
        'pedido_id', 
        'producto_id', 
        'producto_talle_id', 
        'cantidad', 
        'precio_unitario'
    ];
}