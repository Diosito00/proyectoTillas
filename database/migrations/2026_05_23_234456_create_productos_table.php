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
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' autoincremental
            
            // Nuestros datos para las zapatillas
            $table->string('nombre'); 
            $table->text('descripcion')->nullable(); // nullable() significa que puede quedar en blanco
            $table->string('marca'); 
            $table->string('categoria'); // ej: hombre, mujer, nino
            $table->string('deporte_uso')->nullable(); // ej: running, urbano
            decimal('precio', 10, 2) = Hasta 10 dígitos, 2 de ellos para los centavos
            $table->decimal('precio', 10, 2); 
            $table->string('imagen_url')->nullable(); // La ruta de la foto
            
            $table->timestamps(); // Crea mágicamente las columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
