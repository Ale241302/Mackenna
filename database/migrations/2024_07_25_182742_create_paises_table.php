<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Insertar los nombres de todos los países de América
        DB::table('paises')->insert([
            ['nombre' => 'Albania'],
            ['nombre' => 'Alemania'],
            ['nombre' => 'Andorra'],
            ['nombre' => 'Argentina'],
            ['nombre' => 'Armenia'],
            ['nombre' => 'Austria'],
            ['nombre' => 'Azerbaiyán'],
            ['nombre' => 'Bahamas'],
            ['nombre' => 'Barbados'],
            ['nombre' => 'Belice'],
            ['nombre' => 'Bélgica'],
            ['nombre' => 'Bielorrusia'],
            ['nombre' => 'Bolivia'],
            ['nombre' => 'Bosnia y Herzegovina'],
            ['nombre' => 'Brasil'],
            ['nombre' => 'Bulgaria'],
            ['nombre' => 'Canadá'],
            ['nombre' => 'Chile'],
            ['nombre' => 'Chipre'],
            ['nombre' => 'Colombia'],
            ['nombre' => 'Costa Rica'],
            ['nombre' => 'Croacia'],
            ['nombre' => 'Cuba'],
            ['nombre' => 'Dinamarca'],
            ['nombre' => 'Dominica'],
            ['nombre' => 'Ecuador'],
            ['nombre' => 'El Salvador'],
            ['nombre' => 'Eslovaquia'],
            ['nombre' => 'Eslovenia'],
            ['nombre' => 'España'],
            ['nombre' => 'Estados Unidos'],
            ['nombre' => 'Estonia'],
            ['nombre' => 'Finlandia'],
            ['nombre' => 'Francia'],
            ['nombre' => 'Georgia'],
            ['nombre' => 'Granada'],
            ['nombre' => 'Grecia'],
            ['nombre' => 'Guatemala'],
            ['nombre' => 'Guyana'],
            ['nombre' => 'Haití'],
            ['nombre' => 'Honduras'],
            ['nombre' => 'Hungría'],
            ['nombre' => 'Irlanda'],
            ['nombre' => 'Islandia'],
            ['nombre' => 'Italia'],
            ['nombre' => 'Jamaica'],
            ['nombre' => 'Kazajistán'],
            ['nombre' => 'Letonia'],
            ['nombre' => 'Liechtenstein'],
            ['nombre' => 'Lituania'],
            ['nombre' => 'Luxemburgo'],
            ['nombre' => 'Macedonia del Norte'],
            ['nombre' => 'Malta'],
            ['nombre' => 'México'],
            ['nombre' => 'Moldavia'],
            ['nombre' => 'Mónaco'],
            ['nombre' => 'Montenegro'],
            ['nombre' => 'Nicaragua'],
            ['nombre' => 'Noruega'],
            ['nombre' => 'Países Bajos'],
            ['nombre' => 'Panamá'],
            ['nombre' => 'Paraguay'],
            ['nombre' => 'Perú'],
            ['nombre' => 'Polonia'],
            ['nombre' => 'Portugal'],
            ['nombre' => 'Reino Unido'],
            ['nombre' => 'República Checa'],
            ['nombre' => 'República Dominicana'],
            ['nombre' => 'Rumania'],
            ['nombre' => 'Rusia'],
            ['nombre' => 'San Cristóbal y Nieves'],
            ['nombre' => 'San Marino'],
            ['nombre' => 'San Vicente y las Granadinas'],
            ['nombre' => 'Santa Lucía'],
            ['nombre' => 'Serbia'],
            ['nombre' => 'Suecia'],
            ['nombre' => 'Suiza'],
            ['nombre' => 'Surinam'],
            ['nombre' => 'Trinidad y Tobago'],
            ['nombre' => 'Ucrania'],
            ['nombre' => 'Uruguay'],
            ['nombre' => 'Vaticano'],
            ['nombre' => 'Venezuela'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paises');
    }
}
