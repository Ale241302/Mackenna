<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Endroid\QrCode\QrCode as EndroidQrCode;
use Endroid\QrCode\Writer\PngWriter;

class RegistroVehiculo extends Model
{
    use HasFactory;

    protected $table = 'registro_vehiculo';

    protected $fillable = [
        'placa',
        'chasis',
        'llave',
        'kilometros',
        'fecha',
        'color',
        'modelo',
        'codigo',
        'notas',
        'equipamiento_vehiculo',
        'accesorio_vehiculo',
        'estado',
        'uso',
        'propietario',
        'sucursal',
        'aparcado',
        'deposito',
        'compania_seguro',
        'riesgo_seguro',
        'poliza_seguro',
        'aseguradora_seguro',
        'asistencia_seguro',
        'telefono_seguro',
        'aviso',
        'grupo',
        'tipo_combustible',
        'capacidad_combustible',
        'tipo_caja',
        'tipo_vehiculo',
        'documentos',
        'marca',
        'codigo_qr',
        'sucursal_actual',
    ];

    public $timestamps = true;

    protected $casts = [
        'equipamiento_vehiculo' => 'array',
        'accesorio_vehiculo' => 'array',
    ];
    public function modeloVehiculo()
    {
        return $this->belongsTo(ModeloVehiculo::class, 'modelo', 'id');
    }

    // Relación con el modelo MarcaVehiculo
    public function marcaVehiculo()
    {
        return $this->belongsTo(MarcaVehiculo::class, 'marca', 'id');
    }
}
