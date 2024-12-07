<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $table = 'tarifas'; // Nombre de la tabla

    protected $fillable = [
        'nombre',
        'codigo',
        'sucursal',
        'precio',
        'incremento',
        'recargo_fijo',
        'recargo_bimensual',
        'precio_bimensual',
        'incremento_bimensual',
        'precios_kms_bimensual',
        'incrementos_kms_bimensual',
        'recargo_mensual',
        'precio_mensual',
        'incremento_mensual',
        'precios_kms_mensual',
        'incrementos_kms_mensual',
        'recargo_semanal',
        'precio_semanal',
        'incremento_semanal',
        'precios_kms_semanal',
        'incrementos_kms_semanal',
        'recargo_dia',
        'recargo_kms',
        'recargo_hora',
        'tipo_vehiculo',
        'incremento_hora',
        'incremento_dia',
        'incremento_kms2',
        'precio_dia',
        'precio_kms',
        'precio_hora',
        'precios_kms_fijo',
        'precios_kms_hora',
        'precios_kms_dia',
        'precios_kms',
        'incrementos_kms_fijo',
        'incrementos_kms_hora',
        'incrementos_kms_dia',
        'incrementos_kms',
    ];

    protected $casts = [
        'tipo_vehiculo' => 'array', // Asegúrate de que 'tipo_vehiculo' se convierta a un array cuando se lea
    ];
    public function getTipoVehiculos()
    {
        return TipoVehiculo::whereIn('id', $this->tipo_vehiculo)->pluck('nombre', 'id')->toArray();
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal'); // Ajusta el nombre de la columna aquí
    }
}
