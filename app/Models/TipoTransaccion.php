<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TipoTransaccion extends Model
{
    use HasFactory;
    protected $fillable=[
        'codigo',
        'nombre',
        'detalle',
        'tipo',
        'estado',
        'descripcion'
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

    public function getTipoSignoAttribute()
    {
        return $this->tipo==='SUMAR'?'+':'-';
    }
}
