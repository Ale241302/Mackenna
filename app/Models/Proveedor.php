<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'name',
        'tipo_cliente',
        'tipo_documento',
        'numero_documento',
        'municipio',
        'pais',
        'paisn',
        'fachadoc',
        'fachacadoc',
        'numero_carnet',
        'ciudad_carnet',
        'pais_carnet',
        'fachacarnet',
        'fachacacarnet',
        'tipo_carnet',
        'ciudad_nacido',
        'pais_nacido',
        'fachanacido',
        'incidencias',
        'numero_contacto',
        'email',
        'documentos2',
        'direccionh',
        'codigo_postalh',
        'ciudadh',
        'pais_nacidoh',
        'direccionl',
        'codigo_postallocal',
        'ciudadl',
        'pais_nacidol',
        'clienteempresa',
        'incluir_mailing',
        'medio_pago',
        'avisos',
        'observaciones',
        'canales_restringidos',
        'consentimiento',
        'fechas',
        'idiomas',
        'cuenta_contable',
        'apellido',
        'genero',
        'consentimiento_fecha',
        'estado',
        'cliente'
    ];
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'paisn');
    }

    public function paisCarnet()
    {
        return $this->belongsTo(Pais::class, 'pais_carnet');
    }

    public function paisNacido()
    {
        return $this->belongsTo(Pais::class, 'pais_nacido');
    }

    public function municipio()
    {
        return $this->belongsTo(Ciudad::class, 'municipio');
    }

    public function paisdocumento()
    {
        return $this->belongsTo(Pais::class, 'pais_documento');
    }


    public function idiomas()
    {
        return $this->belongsTo(Idioma::class, 'idiomas');
    }
}
