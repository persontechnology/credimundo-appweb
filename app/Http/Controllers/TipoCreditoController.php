<?php

namespace App\Http\Controllers;

use App\DataTables\TipoCreditoDataTable;
use App\Models\TipoCredito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TipoCreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ADMINISTRADOR']);
    }
    public function index(TipoCreditoDataTable $dataTable)
    {
        return $dataTable->render('tipo-creditos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo-creditos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";

        $request->validate([
            'nombre'=>'required|string|max:255|unique:tipo_creditos,nombre',
            'tasa_efectiva_anual'=>'required|regex:'.$rg_decimal.'|gt:0|unique:tipo_creditos,tasa_efectiva_anual',
            'tasa_nominal'=>'required|regex:'.$rg_decimal.'|gt:0',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'tipo'=>'required|in:CREDITO,PLAZO FIJO',
            'descripcion'=>'nullable|string|max:255'
        ]);
        TipoCredito::create($request->all());
        Session::flash('success','Tipo de crédito ingresado.!');
        return redirect()->route('tipo-creditos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoCredito $tipoCredito)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoCredito $tipoCredito)
    {
        $this->authorize('update',$tipoCredito);
        return view('tipo-creditos.edit',['tc'=>$tipoCredito]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoCredito $tipoCredito)
    {
        $this->authorize('update',$tipoCredito);
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";

        $request->validate([
            'nombre'=>'required|string|max:255|unique:tipo_creditos,nombre,'.$tipoCredito->id,
            'tasa_efectiva_anual'=>'required|regex:'.$rg_decimal.'|gt:0|unique:tipo_creditos,tasa_efectiva_anual,'.$tipoCredito->id,
            'tasa_nominal'=>'required|regex:'.$rg_decimal.'|gt:0',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'descripcion'=>'nullable|string|max:255'
        ]);
        $tipoCredito->update($request->all());
        Session::flash('success','Tipo de crédito actualizado.!');
        return redirect()->route('tipo-creditos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoCredito $tipoCredito)
    {
        $this->authorize('delete',$tipoCredito);
        try {
            $tipoCredito->delete();
            Session::flash('success','Tipo de crédito eliminado.!');
        } catch (\Throwable $th) {
            Session::flash('info','Tipo de crédito no eliminado.!');
        }
        return redirect()->route('tipo-creditos.index');
    }
}
