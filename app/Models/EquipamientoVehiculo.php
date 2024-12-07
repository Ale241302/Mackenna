<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipamientoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'equipamiento_vehiculo';

    protected $fillable = [
        'nombre',
    ];
}
