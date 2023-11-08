<?php

namespace App\Http\Controllers;

use App\Http\Clases\ValidadorEc;
use App\Http\Requests\User\RqCambiarContrasena;
use App\Models\TablaCredito;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $fechaActual=Carbon::now()->addDays(2);
        // $tableCreditos=TablaCredito::where('fecha_pago','<=',$fechaActual)
        // ->where(function($query)
        //         {
        //             $query->where('estado','PENDIENTE')->orWhere('estado','ATRASADO');

        //         })->get();
        // $data = array(
        //     'tablas_creditos'=>$tableCreditos
        // );
        return view('home');
    }

    public function validarec(Request $request)
    {
        $validatorEC = new ValidadorEc();
        $res= $validatorEC->validarIdentificacion($request->identificacion);
        return json_encode($res);
    }

    public function miPerfil() {
        $data = array(
            'user'=>Auth::user()
        );
        return view('usuarios.mi-perfil',$data);
    }

    public function actualizarContrasena(RqCambiarContrasena $request) {
        
        
        if(!Hash::check($request->contrasena_actual, auth()->user()->password)){
            return back()->with("danger", "¡La contraseña actual no coincide!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->nueva_contrasena)
        ]);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with("success", "¡Contraseña cambiada con éxito!");

    }

}
