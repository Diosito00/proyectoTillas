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
    Schema::create('ventas', function (Blueprint $table) {
        $table->id();
        // Relaciona la venta con el id del usuario cliente que está logueado
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        $table->decimal('total', 10, 2);
        $table->string('direccion');
        $table->timestamp('fecha');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
