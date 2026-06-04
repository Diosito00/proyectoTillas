<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla en MariaDB.
     */
    public function up(): void
{
    Schema::create('detalle_ventas', function (Blueprint $table) {
        // Clave primaria autoincremental de la fila de detalle
        $table->id();
        // Relación con la cabecera de la venta

        // FK vinculada a la cabecera 'ventas'. Si se borra la venta, elimina sus detalles en cascada
        $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
        // FK vinculada a la tabla de productos (zapatillas) para saber qué se compró
        $table->foreignId('producto_id')->constrained('productos'); 
        // Almacena el número físico de talle seleccionado por el cliente (ej: 42)
        $table->integer('talle'); 
        // Cantidad de unidades adquiridas de este producto en particular
        $table->integer('cantidad');
        // Precio histórico del producto al momento exacto de la compra (evita desfases por inflación)
        $table->decimal('precio_unitario', 10, 2);
        // Columnas automáticas de control de auditoría: created_at y updated_at
        $table->timestamps();
    });
}

    /**
     * Revierte la migración eliminando la tabla completa.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
