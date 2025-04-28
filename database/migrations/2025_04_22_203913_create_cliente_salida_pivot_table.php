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
        Schema::create('cliente_salida', function (Blueprint $table) {
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('salida_inventario_id')->constrained();
            $table->primary(['cliente_id', 'salida_inventario_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_salida');
    }
};
