<?php

namespace App\Http\Controllers;

use App\Http\Clases\ValidadorEc;
use App\Models\TablaCredito;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
