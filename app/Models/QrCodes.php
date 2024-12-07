<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class QrCodes extends Model
{
    use HasFactory;

    protected $table = 'llave_vehiculo'; // Usa la tabla correcta

    protected $fillable = [
        'llave',
        'placa',
        'codigo_qr',
        'capacidad_combustible',
        'tipo_combustible',
        'tipo_caja',
        'grupo',
        'chasis',
        'color',
        'marca',
        'tipo_vehiculo',
        'sucursal',
        'modelo',
    ];

    protected static function booted()
    {
        static::creating(function ($vehiculo) {
            // Generar la llave automática
            $ultimoVehiculo = static::latest('id')->first();
            $ultimoNumero = $ultimoVehiculo ? intval(substr($ultimoVehiculo->llave, 1)) : 0;
            $nuevoNumero = str_pad($ultimoNumero + 1, 2, '0', STR_PAD_LEFT);
            $vehiculo->llave = 'A' . $nuevoNumero;
        });
    }
}
