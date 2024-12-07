<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCiudadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Insertar datos iniciales
        DB::table('ciudades')->insert([
            ['nombre' => 'Arica'],
            ['nombre' => 'Camarones'],
            ['nombre' => 'Putre'],
            ['nombre' => 'General Lagos'],
            ['nombre' => 'Iquique'],
            ['nombre' => 'Alto Hospicio'],
            ['nombre' => 'Pozo Almonte'],
            ['nombre' => 'Camiña'],
            ['nombre' => 'Colchane'],
            ['nombre' => 'Huara'],
            ['nombre' => 'Pica'],
            ['nombre' => 'Antofagasta'],
            ['nombre' => 'Mejillones'],
            ['nombre' => 'Sierra Gorda'],
            ['nombre' => 'Taltal'],
            ['nombre' => 'Calama'],
            ['nombre' => 'Ollagüe'],
            ['nombre' => 'San Pedro de Atacama'],
            ['nombre' => 'Tocopilla'],
            ['nombre' => 'María Elena'],
            ['nombre' => 'Copiapó'],
            ['nombre' => 'Caldera'],
            ['nombre' => 'Tierra Amarilla'],
            ['nombre' => 'Chañaral'],
            ['nombre' => 'Diego de Almagro'],
            ['nombre' => 'Vallenar'],
            ['nombre' => 'Alto del Carmen'],
            ['nombre' => 'Freirina'],
            ['nombre' => 'Huasco'],
            ['nombre' => 'La Serena'],
            ['nombre' => 'Coquimbo'],
            ['nombre' => 'Andacollo'],
            ['nombre' => 'La Higuera'],
            ['nombre' => 'Paiguano'],
            ['nombre' => 'Vicuña'],
            ['nombre' => 'Illapel'],
            ['nombre' => 'Canela'],
            ['nombre' => 'Los Vilos'],
            ['nombre' => 'Salamanca'],
            ['nombre' => 'Ovalle'],
            ['nombre' => 'Combarbalá'],
            ['nombre' => 'Monte Patria'],
            ['nombre' => 'Punitaqui'],
            ['nombre' => 'Río Hurtado'],
            ['nombre' => 'Valparaíso'],
            ['nombre' => 'Casablanca'],
            ['nombre' => 'Concón'],
            ['nombre' => 'Juan Fernández'],
            ['nombre' => 'Puchuncaví'],
            ['nombre' => 'Quintero'],
            ['nombre' => 'Viña del Mar'],
            ['nombre' => 'Isla de Pascua'],
            ['nombre' => 'Los Andes'],
            ['nombre' => 'Calle Larga'],
            ['nombre' => 'Rinconada'],
            ['nombre' => 'San Esteban'],
            ['nombre' => 'La Ligua'],
            ['nombre' => 'Cabildo'],
            ['nombre' => 'Papudo'],
            ['nombre' => 'Petorca'],
            ['nombre' => 'Zapallar'],
            ['nombre' => 'Quillota'],
            ['nombre' => 'Calera'],
            ['nombre' => 'Hijuelas'],
            ['nombre' => 'La Cruz'],
            ['nombre' => 'Nogales'],
            ['nombre' => 'San Antonio'],
            ['nombre' => 'Algarrobo'],
            ['nombre' => 'Cartagena'],
            ['nombre' => 'El Quisco'],
            ['nombre' => 'El Tabo'],
            ['nombre' => 'Santo Domingo'],
            ['nombre' => 'San Felipe'],
            ['nombre' => 'Catemu'],
            ['nombre' => 'Llaillay'],
            ['nombre' => 'Panquehue'],
            ['nombre' => 'Putaendo'],
            ['nombre' => 'Santa María'],
            ['nombre' => 'Quilpué'],
            ['nombre' => 'Limache'],
            ['nombre' => 'Olmué'],
            ['nombre' => 'Villa Alemana'],
            ['nombre' => 'Rancagua'],
            ['nombre' => 'Codegua'],
            ['nombre' => 'Coinco'],
            ['nombre' => 'Coltauco'],
            ['nombre' => 'Doñihue'],
            ['nombre' => 'Graneros'],
            ['nombre' => 'Las Cabras'],
            ['nombre' => 'Machalí'],
            ['nombre' => 'Malloa'],
            ['nombre' => 'Mostazal'],
            ['nombre' => 'Olivar'],
            ['nombre' => 'Peumo'],
            ['nombre' => 'Pichidegua'],
            ['nombre' => 'Quinta de Tilcoco'],
            ['nombre' => 'Rengo'],
            ['nombre' => 'Requínoa'],
            ['nombre' => 'San Vicente'],
            ['nombre' => 'Pichilemu'],
            ['nombre' => 'La Estrella'],
            ['nombre' => 'Litueche'],
            ['nombre' => 'Marchihue'],
            ['nombre' => 'Navidad'],
            ['nombre' => 'Paredones'],
            ['nombre' => 'San Fernando'],
            ['nombre' => 'Chépica'],
            ['nombre' => 'Chimbarongo'],
            ['nombre' => 'Lolol'],
            ['nombre' => 'Nancagua'],
            ['nombre' => 'Palmilla'],
            ['nombre' => 'Peralillo'],
            ['nombre' => 'Placilla'],
            ['nombre' => 'Pumanque'],
            ['nombre' => 'Santa Cruz'],
            ['nombre' => 'Talca'],
            ['nombre' => 'Constitución'],
            ['nombre' => 'Curepto'],
            ['nombre' => 'Empedrado'],
            ['nombre' => 'Maule'],
            ['nombre' => 'Pelarco'],
            ['nombre' => 'Pencahue'],
            ['nombre' => 'Río Claro'],
            ['nombre' => 'San Clemente'],
            ['nombre' => 'San Rafael'],
            ['nombre' => 'Cauquenes'],
            ['nombre' => 'Chanco'],
            ['nombre' => 'Pelluhue'],
            ['nombre' => 'Curicó'],
            ['nombre' => 'Hualañé'],
            ['nombre' => 'Licantén'],
            ['nombre' => 'Molina'],
            ['nombre' => 'Rauco'],
            ['nombre' => 'Romeral'],
            ['nombre' => 'Sagrada Familia'],
            ['nombre' => 'Teno'],
            ['nombre' => 'Vichuquén'],
            ['nombre' => 'Linares'],
            ['nombre' => 'Colbún'],
            ['nombre' => 'Longaví'],
            ['nombre' => 'Parral'],
            ['nombre' => 'Retiro'],
            ['nombre' => 'San Javier'],
            ['nombre' => 'Villa Alegre'],
            ['nombre' => 'Yerbas Buenas'],
            ['nombre' => 'Concepción'],
            ['nombre' => 'Coronel'],
            ['nombre' => 'Chiguayante'],
            ['nombre' => 'Florida'],
            ['nombre' => 'Hualqui'],
            ['nombre' => 'Lota'],
            ['nombre' => 'Penco'],
            ['nombre' => 'San Pedro de la Paz'],
            ['nombre' => 'Santa Juana'],
            ['nombre' => 'Talcahuano'],
            ['nombre' => 'Tomé'],
            ['nombre' => 'Hualpén'],
            ['nombre' => 'Lebu'],
            ['nombre' => 'Arauco'],
            ['nombre' => 'Cañete'],
            ['nombre' => 'Contulmo'],
            ['nombre' => 'Curanilahue'],
            ['nombre' => 'Los Álamos'],
            ['nombre' => 'Tirúa'],
            ['nombre' => 'Los Ángeles'],
            ['nombre' => 'Antuco'],
            ['nombre' => 'Cabrero'],
            ['nombre' => 'Laja'],
            ['nombre' => 'Mulchén'],
            ['nombre' => 'Nacimiento'],
            ['nombre' => 'Negrete'],
            ['nombre' => 'Quilaco'],
            ['nombre' => 'Quilleco'],
            ['nombre' => 'San Rosendo'],
            ['nombre' => 'Santa Bárbara'],
            ['nombre' => 'Tucapel'],
            ['nombre' => 'Yumbel'],
            ['nombre' => 'Alto Biobío'],
            ['nombre' => 'Chillán'],
            ['nombre' => 'Bulnes'],
            ['nombre' => 'Cobquecura'],
            ['nombre' => 'Coelemu'],
            ['nombre' => 'Coihueco'],
            ['nombre' => 'Chillán Viejo'],
            ['nombre' => 'El Carmen'],
            ['nombre' => 'Ninhue'],
            ['nombre' => 'Ñiquén'],
            ['nombre' => 'Pemuco'],
            ['nombre' => 'Pinto'],
            ['nombre' => 'Portezuelo'],
            ['nombre' => 'Quillón'],
            ['nombre' => 'Quirihue'],
            ['nombre' => 'Ránquil'],
            ['nombre' => 'San Carlos'],
            ['nombre' => 'San Fabián'],
            ['nombre' => 'San Ignacio'],
            ['nombre' => 'San Nicolás'],
            ['nombre' => 'Treguaco'],
            ['nombre' => 'Yungay'],
            ['nombre' => 'Temuco'],
            ['nombre' => 'Carahue'],
            ['nombre' => 'Cunco'],
            ['nombre' => 'Curarrehue'],
            ['nombre' => 'Freire'],
            ['nombre' => 'Galvarino'],
            ['nombre' => 'Gorbea'],
            ['nombre' => 'Lautaro'],
            ['nombre' => 'Loncoche'],
            ['nombre' => 'Melipeuco'],
            ['nombre' => 'Nueva Imperial'],
            ['nombre' => 'Padre las Casas'],
            ['nombre' => 'Perquenco'],
            ['nombre' => 'Pitrufquén'],
            ['nombre' => 'Pucón'],
            ['nombre' => 'Saavedra'],
            ['nombre' => 'Teodoro Schmidt'],
            ['nombre' => 'Toltén'],
            ['nombre' => 'Vilcún'],
            ['nombre' => 'Villarrica'],
            ['nombre' => 'Cholchol'],
            ['nombre' => 'Angol'],
            ['nombre' => 'Collipulli'],
            ['nombre' => 'Curacautín'],
            ['nombre' => 'Ercilla'],
            ['nombre' => 'Lonquimay'],
            ['nombre' => 'Los Sauces'],
            ['nombre' => 'Lumaco'],
            ['nombre' => 'Purén'],
            ['nombre' => 'Renaico'],
            ['nombre' => 'Traiguén'],
            ['nombre' => 'Victoria'],
            ['nombre' => 'Valdivia'],
            ['nombre' => 'Corral'],
            ['nombre' => 'Lanco'],
            ['nombre' => 'Los Lagos'],
            ['nombre' => 'Máfil'],
            ['nombre' => 'Mariquina'],
            ['nombre' => 'Paillaco'],
            ['nombre' => 'Panguipulli'],
            ['nombre' => 'La Unión'],
            ['nombre' => 'Futrono'],
            ['nombre' => 'Lago Ranco'],
            ['nombre' => 'Río Bueno'],
            ['nombre' => 'Puerto Montt'],
            ['nombre' => 'Calbuco'],
            ['nombre' => 'Cochamó'],
            ['nombre' => 'Fresia'],
            ['nombre' => 'Frutillar'],
            ['nombre' => 'Los Muermos'],
            ['nombre' => 'Llanquihue'],
            ['nombre' => 'Maullín'],
            ['nombre' => 'Puerto Varas'],
            ['nombre' => 'Castro'],
            ['nombre' => 'Ancud'],
            ['nombre' => 'Chonchi'],
            ['nombre' => 'Curaco de Vélez'],
            ['nombre' => 'Dalcahue'],
            ['nombre' => 'Puqueldón'],
            ['nombre' => 'Queilén'],
            ['nombre' => 'Quellón'],
            ['nombre' => 'Quemchi'],
            ['nombre' => 'Quinchao'],
            ['nombre' => 'Osorno'],
            ['nombre' => 'Puerto Octay'],
            ['nombre' => 'Purranque'],
            ['nombre' => 'Puyehue'],
            ['nombre' => 'Río Negro'],
            ['nombre' => 'San Juan de la Costa'],
            ['nombre' => 'San Pablo'],
            ['nombre' => 'Chaitén'],
            ['nombre' => 'Futaleufú'],
            ['nombre' => 'Hualaihué'],
            ['nombre' => 'Palena'],
            ['nombre' => 'Coyhaique'],
            ['nombre' => 'Lago Verde'],
            ['nombre' => 'Aysén'],
            ['nombre' => 'Cisnes'],
            ['nombre' => 'Guaitecas'],
            ['nombre' => 'Cochrane'],
            ['nombre' => 'O’Higgins'],
            ['nombre' => 'Tortel'],
            ['nombre' => 'Chile Chico'],
            ['nombre' => 'Río Ibáñez'],
            ['nombre' => 'Punta Arenas'],
            ['nombre' => 'Laguna Blanca'],
            ['nombre' => 'Río Verde'],
            ['nombre' => 'San Gregorio'],
            ['nombre' => 'Cabo de Hornos'],
            ['nombre' => 'Antártica'],
            ['nombre' => 'Porvenir'],
            ['nombre' => 'Primavera'],
            ['nombre' => 'Timaukel'],
            ['nombre' => 'Natales'],
            ['nombre' => 'Torres del Paine']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciudades');
    }
}
