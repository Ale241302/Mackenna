<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoVehiculo extends Model
{
    use HasFactory;
    protected $table = 'grupo_vehiculo';
    protected $fillable = ['nombre']; // Asegúrate de incluir 'nombre'
}
