<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Agregamos la columna 'rol', por defecto todos son clientes.
            // La colocamos después del password para mantener el orden visual.
            $table->string('rol')->default('cliente')->after('password');
        });
    }

    public function down(): void
    {
        // Esto es por si necesitamos revertir (rollback) el cambio en el futuro
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol');
        });
    }
};
