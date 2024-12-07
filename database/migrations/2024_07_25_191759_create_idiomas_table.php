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
        Schema::create('idiomas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
        DB::table('idiomas')->insert([
            ['nombre' => 'Español'],
            ['nombre' => 'Inglés'],
            ['nombre' => 'Francés'],
            ['nombre' => 'Portugués'],
            ['nombre' => 'Alemán'],
            ['nombre' => 'Italiano'],
            ['nombre' => 'Chino'],
            ['nombre' => 'Japonés'],
            ['nombre' => 'Coreano'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idiomas');
    }
};
