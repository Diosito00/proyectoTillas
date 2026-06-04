<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    // Habilita la asignación masiva de datos mediante el array $fillable para poder insertar registros de golpe
    protected $fillable = ['user_id', 'total', 'direccion', 'fecha'];

    /**
     * RELACIÓN ELOQUENT: Una venta posee muchos artículos vinculados.
     * Define una relación de uno a muchos (1 a N) con el modelo DetalleVenta.
     * Permite recuperar el desglose de productos individuales mediante: $compra->detalles
     */
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}