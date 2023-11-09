<?php

namespace App\Http\Controllers;

use App\Models\TablaCredito;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ADMINISTRADOR|SECRETARIA']);
    }
    
    public function index() {
        $fechaActual=Carbon::now()->addDays(2);
        $tableCreditos=TablaCredito::where('fecha_pago','<=',$fechaActual)
        ->where(function($query)
                {
                    $query->where('estado','PENDIENTE')->orWhere('estado','ATRASADO');

                })->get();
        $data = array(
            'tablas_creditos'=>$tableCreditos
        );
        return view('reportes.index',$data);
    }
}
