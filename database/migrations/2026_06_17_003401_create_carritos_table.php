<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Dueño del carrito
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->foreignId('producto_talle_id')->constrained('producto_talles')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2); // Guardamos el precio al momento de agregarlo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};
