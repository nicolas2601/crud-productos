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
        Schema::create('proveedor_salida_pivot', function (Blueprint $table) {
            $table->foreignId('proveedor_id')->constrained()->onDelete('cascade');
            $table->foreignId('salida_inventario_id')->constrained()->onDelete('cascade');
            $table->primary(['proveedor_id', 'salida_inventario_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedor_salida_pivot');
    }
};
