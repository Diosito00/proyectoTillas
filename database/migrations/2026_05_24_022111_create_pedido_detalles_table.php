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
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->id();
            
            // A qué ticket de compra pertenece este renglón
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            
            // Qué zapatilla llevó y en qué talle
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('producto_talle_id')->constrained('producto_talles');
            
            // Cuántos pares llevó de este talle exacto
            $table->integer('cantidad');
            
            // Guardamos el precio histórico. Si mañana la zapatilla aumenta, 
            // este ticket debe mantener el precio al que la compró hoy.
            $table->decimal('precio_unitario', 10, 2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_detalles');
    }
};
