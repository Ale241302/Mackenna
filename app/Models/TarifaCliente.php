<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifaCliente extends Model
{
    protected $table = 'tarifa_combustible'; // Nombre de la tabla

    protected $fillable = [
        'nombre',
        'sucursal',
        'combustible',
        'coste',
        'pvp',
        'iva',
        'cantidad_existente',
        'cantidad_comprada',
        'capacidad',
        'proveedor',

    ];
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal'); // Ajusta el nombre de la columna aquí
    }
}
