<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    // Especificar el nombre de la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'paises';

    // Especificar los campos que se pueden asignar de manera masiva
    protected $fillable = ['nombre'];

    // Opcional: Deshabilitar timestamps si no necesitas 'created_at' y 'updated_at'
    public $timestamps = true;
}
