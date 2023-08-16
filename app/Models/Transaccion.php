<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaccion extends Model
{
    use HasFactory;

    protected $fillable=[
        'numero',
        'valor',
        'valor_disponible',
        'estado',
        'detalle',
        'cuenta_user_id',
        'tipo_transaccion_id',
        'tipo_transaccion_id',
        'quien_realiza_transaccion',
        'identificacion_otra_persona',
        'nombre_otra_persona',
        'tabla_credito_id',
        'tabla_plazo_fijo_id'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->creado_x=Auth::id();
            $model->numero = $model->NumeroSiguente();
            $model->numero_libreta=$model->NumeroLibretaSiguente();
        });
        self::updating(function($model){
            $model->actualizado_x = Auth::id();
        });
        
        // Deivid, actualizar valor disponible cuentauser
        self::created(function($model){

            switch ($model->tipoTransaccion->tipo) {
                case 'RESTAR':
                    $model->cuentaUser->valor_disponible=$model->cuentaUser->valor_disponible-$model->valor;   
                    break;
                case 'SUMAR':
                    $model->cuentaUser->valor_disponible=$model->cuentaUser->valor_disponible+$model->valor;   
                    break;
                default:
                    break;
            }
            $model->cuentaUser->save();
            $model->valor_disponible=$model->cuentaUser->valor_disponible;
            $model->save();
         });

         self::updated(function($model){
            
         });
    }

    //Deivid, crear numero siguente para la orden

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

    public function NumeroLibretaSiguente()
    {
        $trans=$this->where('cuenta_user_id',$this->cuenta_user_id)
        ->where('estado','OK')
        ->select('numero_libreta')->latest('id')->first();
        $numeroGenerado=1;
        if($trans){
            
                $numeroGenerado=$trans->numero_libreta+1;

                switch ($numeroGenerado) {
                    case 26:
                    case 27:
                        $numeroGenerado=28;
                        break;
                    case 57:
                    case 58:
                        $numeroGenerado=59;
                        break;
                    case 88:
                    case 89:
                        $numeroGenerado=90;
                        break;
                    case $numeroGenerado>118:
                        $numeroGenerado=1;
                    default:
                        break;
                }


        }
        return $numeroGenerado;
    }


     // Deivid, una transaccion tiene una cuentauser
    public function cuentaUser()
    {
        return $this->belongsTo(CuentaUser::class, 'cuenta_user_id');
    }

    // Deivid, una transaccion tiene u tipotransaccion
    public function tipoTransaccion()
    {
        return $this->belongsTo(TipoTransaccion::class,'tipo_transaccion_id');
    }

    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creado_x');
    }
    public function actualizadoPor()
    {
        return $this->belongsTo(User::class, 'actualizado_x');
    }
    
    
}
