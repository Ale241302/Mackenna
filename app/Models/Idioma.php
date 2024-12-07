<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    // Especifica la tabla asociada al modelo
    protected $table = 'idiomas';

    // Indica los campos que se pueden llenar mediante asignación masiva
    protected $fillable = [
        'nombre',

    ];

    // Habilita los timestamps si deseas utilizarlos (created_at y updated_at)
    public $timestamps = true;
}
