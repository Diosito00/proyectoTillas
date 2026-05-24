<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            
            // Conectamos el pedido con el usuario que inició sesión
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Guardamos el total final que pagó
            $table->decimal('total', 10, 2);
            
            // Estado del pedido (ej: pendiente, pagado, enviado)
            $table->string('estado')->default('pendiente');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
