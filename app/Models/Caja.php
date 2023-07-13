<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $fillable=[
        'valor_apertura',
        'valor_cierre',
        'total',
        'detalle_apertura',
        'detalle_cierre',
        'estado',
        'fecha'
    ];
}
