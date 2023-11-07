<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MisCuentasController extends Controller
{
    public function index(){
        $data = array(
            'misCuentas'=>Auth::user()->cuentaUser
        );
        return view('mis-cuentas.index',$data);
    }
}
