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
        Schema::create('tipo_itv', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Insertar nombres de revisiones tecnomecánicas
        DB::table('tipo_itv')->insert([
            ['nombre' => 'Inspección Técnica Anual'],
            ['nombre' => 'Inspección Técnica Preventiva'],
            ['nombre' => 'Inspección de Emisiones Contaminantes'],
            ['nombre' => 'Inspección de Frenos'],
            ['nombre' => 'Inspección de Seguridad Vehicular'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_itv');
    }
};
