<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesorioVehiculo extends Model
{
    use HasFactory;

    protected $table = 'accesorio_vehiculo';

    protected $fillable = [
        'nombre',
        'precio',
    ];
}
