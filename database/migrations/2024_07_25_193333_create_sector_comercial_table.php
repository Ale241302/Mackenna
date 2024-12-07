<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorComercialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_comercial', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Insertar datos iniciales
        DB::table('sector_comercial')->insert([
            ['nombre' => 'Retail (Venta al por menor)'],
            ['nombre' => 'Comercio Mayorista'],
            ['nombre' => 'Comercio Electrónico'],
            ['nombre' => 'Alimentación y Bebidas'],
            ['nombre' => 'Moda y Textiles'],
            ['nombre' => 'Franquicias'],
            ['nombre' => 'Servicios Comerciales'],
            ['nombre' => 'Comercio Internacional'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sector_comercial');
    }
}
