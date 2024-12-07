<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorComercial extends Model
{
    use HasFactory;

    // El nombre de la tabla en la base de datos
    protected $table = 'sector_comercial';

    // Los campos que se pueden asignar de forma masiva
    protected $fillable = ['nombre'];

    // Opcional: Si no deseas que se usen las marcas de tiempo (timestamps), descomentar la línea siguiente
    public $timestamps = false;
}
