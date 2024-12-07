<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    // Si el nombre de la tabla en la base de datos no sigue la convención plural
    protected $table = 'sucursales';

    // Si la tabla no tiene timestamps
    public $timestamps = true;

    // Los atributos que se pueden asignar masivamente
    protected $fillable = ['nombre', 'ciudad', 'direccion', 'tipo_sucursal'];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id'); // Asegúrate de que el campo 'ciudad_id' sea correcto
    }
}
