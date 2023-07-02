<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TipoCuenta extends Model
{
    use HasFactory;
    protected $fillable=[
        'codigo',
        'nombre',
        'valor_apertura',
        'valor_debito',
        'estado',
        'descripcion',
        'creado_x',
        'actualizado_x',
    ];
    

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->creado_x = Auth::id();
        });
        self::updating(function($model){
            $model->actualizado_x = Auth::id();
        });
    }
}
