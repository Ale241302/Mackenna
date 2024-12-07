<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraCliente extends Model
{
    protected $table = 'extra_cliente'; // Nombre de la tabla

    protected $fillable = [
        'nombre',
        'porcentaje',

    ];
}
