<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MisCreditosController extends Controller
{
    public function index() {
        $user=Auth::user();
        $data = array(
            'misCreditos'=>$user->creditos
        );

        return view('mis-creditos.index',$data);
    }
}
