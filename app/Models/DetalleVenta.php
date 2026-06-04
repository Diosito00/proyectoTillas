<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    // Laravel por defecto buscará la tabla "detalle_ventas", lo aclaramos por las dudas
    protected $table = 'detalle_ventas'; 

    protected $fillable = ['venta_id', 'producto_id', 'talle', 'cantidad', 'precio_unitario'];

    // Relación: El detalle pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}