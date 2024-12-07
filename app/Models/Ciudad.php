<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    // Si el nombre de la tabla en la base de datos no sigue la convención plural
    protected $table = 'ciudades';

    // Si la tabla no tiene timestamps
    public $timestamps = true;

    // Los atributos que se pueden asignar masivamente
    protected $fillable = ['nombre', 'pais_id'];

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }
}
