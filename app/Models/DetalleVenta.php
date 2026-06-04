<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    // Laravel por defecto buscará la tabla "detalle_ventas", lo aclaramos por las dudas
    protected $table = 'detalle_ventas'; 

    // Especifica las columnas que permiten la carga masiva de datos (Mass Assignment) desde el controlador
    protected $fillable = ['venta_id', 'producto_id', 'talle', 'cantidad', 'precio_unitario'];

    /**
     * RELACIÓN ELOQUENT: Cada línea de detalle pertenece a un único producto.
     * Define una relación inversa de muchos a uno (N a 1) con el modelo Producto.
     * Permite acceder a los datos de la zapatilla (nombre, marca, imagen) desde el detalle: $detalle->producto->nombre
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}