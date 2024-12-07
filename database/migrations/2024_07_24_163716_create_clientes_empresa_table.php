<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tipo_cliente');
            $table->string('cuenta_contable');
            $table->string('razon_social');
            $table->string('sector_economico');
            $table->string('direccion');
            $table->string('codigo_postal');
            $table->string('municipio');
            $table->string('pais');
            $table->string('provincia');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('pais_documento');
            $table->string('persona_contacto');
            $table->string('numero_contacto');
            $table->string('email');
            $table->string('web');
            $table->string('sucursal');
            $table->string('idiomas');
            $table->string('observaciones');
            $table->string('medio_pago');
            $table->integer('dias_credito');
            $table->string('canal');
            $table->string('vent_dia');
            $table->string('vehiculo_propio');
            $table->string('acuerdos');
            $table->string('opciones');
            $table->string('tarifas');
            $table->string('documento');
            $table->string('documento2');
            $table->string('documento3');
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
        Schema::dropIfExists('clientes_empresa');
    }
}
