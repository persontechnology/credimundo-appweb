<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CodigoDeAcceso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nombres',
        'apellidos',
        'identificacion',
        'provincia',
        'canton',
        'parroquia',
        'recinto',
        'direccion',
        'telefono',
        'celular',
        'lugar_nacimiento',
        'fecha_nacimiento',
        'nacionalidad',
        'estado_civil',
        'foto',
        'foto_identificacion',
        'estado',
        'sexo',
        'nombre_conyuge',
        'identificacion_conyuge',
        'celular_conyuge',
        'nombre_representante',
        'identificacion_representante',
        'parentesco_representante',
        'celular_representante',
        'creado_x',
        'actualizado_x',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Deivid, se genera el codigo de 6 digitos para el acceso
    public function generarCodigoLogin()
    {
        $user=Auth::user();
        $code=random_int(100000,999999);
        UserCode::updateOrCreate(
            ['user_id'=>$user->id],
            ['codigo'=>$code]
        );

        try {
            $data = array(
                'titulo' => 'El código de acceeso para el sistema es.',
                'codigo'=>$code
            );
            $user->notify(new CodigoDeAcceso($data));
        } catch (\Throwable $th) {
            
        }
    }

    public function getApellidosNombresAttribute()
    {
        return "{$this->apellidos} {$this->nombres}";
    }

    // usuario es garante de un credito si o no
    public function esGarante($idUser,$idCredito)
    {
        $creditoGarante=CreditoGarante::where(['credito_id'=>$idCredito,'user_id'=>$idUser])->first();
        if($creditoGarante){
            return true;
        }else{
            return false;
        }
    }

    // un usuario tiene varias cuentas activas
    // este es para la vista del socio
    public function cuentaUser()
    {
        return $this->hasMany(CuentaUser::class)->where('estado','ACTIVO');
    }

    // Deivid, un usuario tiene varios creditos en estado entregado
    // este es para vista de socios
    public function creditos()
    {
        return $this->hasManyThrough(
            Credito::class,
            CuentaUser::class,
            'user_id', // Foreign key on the cuenta_users table...
            'cuenta_user_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        )
        ->where('creditos.estado','ENTREGADO');
    }
    
}
