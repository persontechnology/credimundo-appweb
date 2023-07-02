<?php

namespace App\Http\Controllers;

use App\Models\UserCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckTwoFactorCotroller extends Controller
{
    public function index()
    {
        return view('check-two-factor.index');
    }

    public function crear(Request $request)
    {
        $request->validate([
            'codigo'=>'required|digits:6'
        ]);
        $user=Auth::user();

        $find=UserCode::where('user_id',$user->id)->where('codigo',$request->codigo)
        ->where('updated_at','>=',now()->subMinutes(2))->first();

        if(!is_null($find)){
            Session::put('user_2fa',$user->id);
            return redirect()->route('home');
        }
        
        return back()->withInput()->withErrors(['codigo'=>'Ingresaste un código incorrecto']);
    }

    public function reenviar()
    {
        $user=Auth::user();
        $user->generarCodigoLogin();
        return back()->with('success', 'Le enviamos el código a su correo electrónico.');
    }
}
