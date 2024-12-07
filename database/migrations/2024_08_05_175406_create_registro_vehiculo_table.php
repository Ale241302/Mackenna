<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->string('placa');
            $table->string('chasis');
            $table->string('llave');
            $table->integer('kilometros');
            $table->date('fecha');
            $table->string('color');
            $table->string('modelo');
            $table->string('codigo');
            $table->string('notas', 500);
            $table->string('equipamiento');
            $table->string('accesorios');
            $table->string('estado')->default('LIBRE');
            $table->string('uso');
            $table->string('propietario');
            $table->string('sucursal');
            $table->string('aparcado');
            $table->string('deposito');
            $table->string('compania_seguro');
            $table->string('riesgo_seguro');
            $table->string('poliza_seguro');
            $table->string('aseguradora_seguro');
            $table->string('asistencia_seguro');
            $table->string('telefono_seguro');
            $table->string('aviso', 500);
            $table->string('documento_1');
            $table->string('documento_2');
            $table->string('documento_3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_vehiculo');
    }
}
