<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaVehiculo extends Model
{
    use HasFactory;

    protected $table = 'marca_vehiculo';

    protected $fillable = ['nombre'];
    public function modelos()
    {
        return $this->hasMany(ModeloVehiculo::class, 'marca', 'id');
    }
}
