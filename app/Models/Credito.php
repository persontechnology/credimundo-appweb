<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Credito extends Model
{
    use HasFactory;

    protected $fillable=[
        
        'monto',
        'solca',
        'interes_certificado_plazo_fijo',
        'total_certificado_plazo_fijo',
        'neto_recibir',
        'dia_pago',
        'numero_cuotas',
        'plazo',
        'pago_mensual',
        'pago_total',
        'interes_total',
        'detalle',
        'actividad',
        'tipo_credito_id',
        'cuenta_user_id',
        'fecha_vencimiento'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->creado_x=Auth::id();
            $model->numero = $model->NumeroSiguente();
            $model->estado='INGRESADO';
            $model->fecha_ingresado=Carbon::now();
        });
        self::updating(function($model){
            $model->actualizado_x = Auth::id();
        });
        self::created(function($model){
            $model->tasa_efectiva_anual=$model->tipoCredito->tasa_efectiva_anual;
            $model->tasa_nominal=$model->tipoCredito->tasa_nominal;
            $model->save();
         });
        self::updated(function($model){
           
        });
    }

    public function scopeNumeroSiguente()
    {
        $orden = $this->select('numero')->latest('id')->first();
        if ($orden) {
            $ordenNumeroGenerado = $orden->numero + 1;
        } else {
            $ordenNumeroGenerado = 1;
        }
        return $ordenNumeroGenerado;
    }

    public function cuentaUser()
    {
        return $this->belongsTo(CuentaUser::class,'cuenta_user_id');
    }
    public function tipoCredito()
    {
        return $this->belongsTo(TipoCredito::class,'tipo_credito_id');
    }
    public function tablaCreditos()
    {
        return $this->hasMany(TablaCredito::class, 'credito_id');
    }
    
    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creado_x');
    }
    
    
    public function garantes()
    {
        return $this->belongsToMany(User::class, 'credito_garantes', 'credito_id', 'user_id');
    }
    
    
}
