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
        Schema::create('modelo_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo_combustible');
            $table->string('capacidad_combustible');
            $table->string('tipo_caja');
            $table->string('equipamiento_vehiculo');
            $table->string('accesorio_vehiculo');
            $table->string('tipo_itv');
            $table->string('grafico_vehiculo_id');
            $table->string('tipo_vehiculo');
            $table->string('marca');
            $table->string('grupo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelo_vehiculo');
    }
};
