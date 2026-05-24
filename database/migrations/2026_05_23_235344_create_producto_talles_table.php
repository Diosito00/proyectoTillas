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
        Schema::create('producto_talles', function (Blueprint $table) {
            $table->id();
            
            // Llave foránea que conecta con la tabla 'productos'
            // onDelete('cascade') hace que si borras la zapatilla, se borren automáticamente todos sus talles
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            
            // El número de talle (usamos decimal por si en algún momento vendes talles como 39.5)
            $table->decimal('talle', 4, 1); 
            
            // El stock específico para ESTE talle
            $table->integer('stock')->default(0); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_talles');
    }
};
