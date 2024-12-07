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
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Insert initial data
        DB::table('permisos')->insert([
            ['nombre' => 'crear marca', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'ver marca', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'editar marca', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'eliminar marca', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'crear clase vehículo', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'editar clase vehículo', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'ver clase vehículo', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'eliminar clase vehículo', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'crear roles', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'ver roles', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'editar roles', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'eliminar roles', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
