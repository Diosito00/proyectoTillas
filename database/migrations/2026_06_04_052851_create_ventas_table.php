<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla de cabecera en MariaDB.
     */
    public function up(): void
{
    Schema::create('ventas', function (Blueprint $table) {
        // Clave primaria autoincremental única para identificar la orden de compra
        $table->id();
        // FK que vincula la venta con el ID del usuario en la tabla 'users'. Si el usuario se elimina, borra sus ventas
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        // Monto acumulado final de la compra (suma de todos los subtotales de las zapatillas)
        $table->decimal('total', 10, 2);
        // Almacena la dirección física ingresada en el checkout para el despacho del pedido
        $table->string('direccion');
        // Registra el momento exacto del pago (utilizando la zona horaria de Buenos Aires configurada)
        $table->timestamp('fecha');
        // Columnas de auditoría interna de Laravel: created_at y updated_at
        $table->timestamps();
    });
}

    /**
     * Revierte la migración eliminando la tabla de la base de datos.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
