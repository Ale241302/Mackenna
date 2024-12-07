<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'vehiculoid',
        'userid',
        'fechar',
        'sucursalid',
    ];

    // Relación con el modelo RegistroVehiculo
    public function vehiculo()
    {
        return $this->belongsTo(RegistroVehiculo::class, 'vehiculoid');
    }

    // Relación con el modelo User (usuarios)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    // Relación con el modelo Sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursalid');
    }
}
