<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canalventa extends Model
{
    use HasFactory;

    // Define los campos que son asignables
    protected $table = 'canal_venta';
    protected $fillable = ['nombre'];
}
