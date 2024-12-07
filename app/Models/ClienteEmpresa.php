<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteEmpresa extends Model
{
    use HasFactory;

    protected $table = 'clientes_empresa';

    // En tu modelo ClienteEmpresa
    protected $fillable = [
        'name',
        'tipo_cliente',
        'cuenta_contable',
        'razon_social',
        'sector_economico',
        'direccion',
        'codigo_postal',
        'municipio',
        'pais',
        'provincia',
        'tipo_documento',
        'numero_documento',
        'pais_documento',
        'persona_contacto',
        'numero_contacto',
        'email',
        'web',
        'sucursal',
        'idiomas',
        'observaciones',
        'medio_pago',
        'dias_credito',
        'canal',
        'vent_dia',
        'vehiculo_propio',
        'acuerdos',
        'opciones',
        'tarifas',
        'extras',
        'documentos2',
        'estado_cliente'
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento');
    }
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais');
    }
    public function municipio()
    {
        return $this->belongsTo(Ciudad::class, 'municipio');
    }
    public function sectorcomercial()
    {
        return $this->belongsTo(SectorComercial::class, 'sector_economico'); // Cambia 'sector_comercial' a 'sector_economico'
    }

    public function paisdocumento()
    {
        return $this->belongsTo(Pais::class, 'pais_documento');
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal');
    }
    public function idiomas()
    {
        return $this->belongsTo(Idioma::class, 'idiomas');
    }
}
