<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    // Forzar a Laravel a incluir el número de factura virtual en los resultados del modelo
    protected $appends = ['numero_factura'];
    
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

    /**
     * ACCESOR DINÁMICO: Genera el número de factura de forma virtual.
     * Al consultar $venta->numero_factura, Laravel ejecutará este código automáticamente.
     * Toma el ID de la venta y lo rellena con ceros a la izquierda (Ej: ID 4 -> FAC-000004).
     */
    public function getNumeroFacturaAttribute()
    {
        return 'FAC-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}