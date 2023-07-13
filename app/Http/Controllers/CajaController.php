<?php

namespace App\Http\Controllers;

use App\DataTables\CajaDataTable;
use App\Models\Caja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CajaDataTable $cajaDataTable)
    {
        return $cajaDataTable->render('caja.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('caja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        $request->validate([
            'detalle_apertura'=>'required',
            'valor_apertura'=>'required|numeric|gt:0|regex:'.$rg_decimal,
        ]);
        $cajaAPERTURADO=Caja::where('estado','APERTURADO')->first();
        if($cajaAPERTURADO){
            Session::flash('info','CAJA NO CREADPO PORQUE EXISTE UNA CUENTA EN ESTADO '.$cajaAPERTURADO->estado);
            return redirect()->back()->withInput();
        }else{
            $caja=new Caja();
            $caja->valor_apertura=$request->valor_apertura;
            $caja->valor_cierre=0;
            $caja->total=$request->valor_apertura;
            $caja->detalle_apertura=$request->detalle_apertura;
            $caja->detalle_cierre='';
            $caja->estado='APERTURADO';
            $caja->fecha=Carbon::today();
            $caja->save();
            Session::flash('success','Caja aperturado exitosamente.!');
            return redirect()->route('caja.index');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Caja $caja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Caja $caja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caja $caja)
    {
        //
    }
}
