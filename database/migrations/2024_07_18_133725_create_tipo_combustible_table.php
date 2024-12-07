<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_combustible', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Insertar tipos de combustibles
        DB::table('tipo_combustible')->insert([
            ['nombre' => 'Gasolina'],
            ['nombre' => 'Diésel'],
            ['nombre' => 'Gas Licuado de Petróleo (GLP)'],
            ['nombre' => 'Gas Natural Comprimido (GNC)'],
            ['nombre' => 'Eléctrico'],
            ['nombre' => 'Híbrido'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_combustible');
    }
};
