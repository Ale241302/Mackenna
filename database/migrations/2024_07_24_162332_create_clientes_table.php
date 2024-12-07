<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tipo_cliente');
            $table->string('tipo_identificacion');
            $table->string('identificacion');
            $table->string('ciudad_expedicion_identificacion');
            $table->string('identificacion_pais');
            $table->date('fecha_expedicion_identificacion');
            $table->date('fecha_caducidad_identificacion');
            $table->string('carnet');
            $table->string('ciudad_expedicion_carnet');
            $table->string('carnet_pais');
            $table->date('carnet_fecha_expedicion');
            $table->date('carnet_fecha_caducidad');
            $table->string('tipo_carnet');
            $table->string('ciudad_nacido');
            $table->string('pais_nacido');
            $table->date('fecha_nacido');
            $table->text('indicendias');
            $table->string('numero_telefonico');
            $table->string('email');
            $table->string('foto_identificacion');
            $table->string('foto_licencia');
            $table->string('foto_cliente');
            $table->string('direccion_habitual');
            $table->string('codigo_postal_habitual');
            $table->string('municipio_habitual');
            $table->string('provincia_habitual');
            $table->string('pais_habitual');
            $table->string('direccion_local');
            $table->string('codigo_postal_local');
            $table->string('municipio_local');
            $table->string('provincia_local');
            $table->string('pais_local');
            $table->string('conductor_empresa');
            $table->string('mailing');
            $table->string('estado');
            $table->string('medio_pago');
            $table->string('observaciones');
            $table->string('avisos');
            $table->string('canles_restringidos');
            $table->string('consentimiento');
            $table->string('inhabilidades');
            $table->string('idiomas');
            $table->string('estado_cliente');
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
        Schema::dropIfExists('clientes');
    }
}
