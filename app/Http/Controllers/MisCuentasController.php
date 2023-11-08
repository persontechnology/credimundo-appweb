<?php

namespace App\Http\Controllers;

use App\Models\CuentaUser;
use App\Notifications\NotyEnviarMasMovimientoCorreo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use PDF;
class MisCuentasController extends Controller
{
    public function index(){
        $data = array(
            'misCuentas'=>Auth::user()->cuentaUser
        );
        return view('mis-cuentas.index',$data);
    }

    public function detalle($id) {
        return $id;
    }

    public function enviarMasMovimientoCorreo(Request $request) {
        $request->validate([
            'fecha_inicio'=>'required|date',
            'fecha_final'=>'required|date|after_or_equal:fecha_inicio',
            'cuentaUser'=>[
                'required',
                Rule::exists('cuenta_users','id')->where(function($query){
                    return $query->where('user_id', Auth::id());
                })
            ]
            
        ]);

        // BUSCAR CEUNTA Y TRANSACIONES 
        $cuentaUser=CuentaUser::findOrFail($request->cuentaUser);        
        $transaciones= $cuentaUser->transacciones()
        ->whereBetween('created_at',[Carbon::parse($request->fecha_inicio)->format('Y-m-d 00:00:00'),Carbon::parse($request->fecha_final)->format('Y-m-d 23:59:59')])->get();

        $title='MOVIMIENTOS DE CUENTA';
        $data = array(
            'title'=>$title,
            'transaciones'=>$transaciones,
            'cuentaUser'=>$cuentaUser,
            'fecha_inicio'=>$request->fecha_inicio,
            'fecha_final'=>$request->fecha_final
        );
        $cuentaUser->user->notify(new NotyEnviarMasMovimientoCorreo($data));

        Session::flash('success','SE ENVIO LOS MOVIMIENTOS DE CUENTA A SU CORREO');
        return redirect()->route('mis-cuentas');
        
    }
}
