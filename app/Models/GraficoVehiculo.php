<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraficoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'grafico_vehiculo';

    protected $fillable = [
        'nombre',
        'ruta_archivo',
    ];
}
