<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ciudad');
            $table->string('direccion');
            $table->string('tipo_sucursal');
            $table->timestamps();
        });

        // Insertar datos iniciales
        DB::table('sucursales')->insert([
            ['nombre' => 'Rac portales', 'ciudad' => 'Osorno', 'direccion' => 'Direccion 1', 'tipo_sucursal' => 'Sucursal'],
            ['nombre' => 'Rac aeropuerto ZOS', 'ciudad' => 'Osorno', 'direccion' => 'Direccion 2', 'tipo_sucursal' => 'Sucursal'],
            ['nombre' => 'taller blanco encalada', 'ciudad' => 'Osorno', 'direccion' => 'Direccion 3', 'tipo_sucursal' => 'Taller'],
            ['nombre' => 'bodega Pilauco', 'ciudad' => 'Osorno', 'direccion' => 'Direccion 4', 'tipo_sucursal' => 'Bodega'],
            ['nombre' => 'automotriz Freire', 'ciudad' => 'Osorno', 'direccion' => 'Direccion 5', 'tipo_sucursal' => 'Sucursal'],
            ['nombre' => 'bodega automotriz Freire', 'ciudad' => 'Osorno', 'direccion' => 'Direccion 6', 'tipo_sucursal' => 'Bodega'],
            ['nombre' => 'Rac Pedro Aguirre cerda 18', 'ciudad' => 'Puerto Montt', 'direccion' => 'Direccion 7', 'tipo_sucursal' => 'Sucursal'],
            ['nombre' => 'Rac aeropuerto Tepual', 'ciudad' => 'Puerto Montt', 'direccion' => 'Direccion 8', 'tipo_sucursal' => 'Sucursal'],
            ['nombre' => 'bodega aeropuerto tepual', 'ciudad' => 'Puerto Montt', 'direccion' => 'Direccion 9', 'tipo_sucursal' => 'Bodega'],
            ['nombre' => 'estacionamiento tepual', 'ciudad' => 'Puerto Montt', 'direccion' => 'Direccion 10', 'tipo_sucursal' => 'Estacionamiento'],
            ['nombre' => 'estacionamiento Tepual II', 'ciudad' => 'Puerto Montt', 'direccion' => 'Direccion 11', 'tipo_sucursal' => 'Estacionamiento'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursales');
    }
}
