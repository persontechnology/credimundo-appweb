<?php

namespace App\Http\Controllers;

use App\DataTables\TipoCuentaDataTable;
use App\Models\TipoCuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TipoCuentaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ADMINISTRADOR']);
    }
    
    public function index(TipoCuentaDataTable $dataTable)
    {
        return $dataTable->render('tipo-cuentas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo-cuentas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";

        $request->validate([
            'codigo'=>'required|string|max:255|unique:tipo_cuentas,codigo',
            'nombre'=>'required|string|max:255|unique:tipo_cuentas,nombre',
            'valor_apertura'=>'required|regex:'.$rg_decimal.'|gte:0',
            'valor_debito'=>'required|regex:'.$rg_decimal.'|lte:valor_apertura',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'descripcion'=>'nullable|string|max:255'
        ]);
        TipoCuenta::create($request->all());
        Session::flash('success','Tipo de cuenta ingresado.!');
        return redirect()->route('tipo-cuentas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoCuenta $tipoCuenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoCuenta $tipoCuenta)
    {
        $this->authorize('update',$tipoCuenta);
        return view('tipo-cuentas.edit',['tc'=>$tipoCuenta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoCuenta $tipoCuenta)
    {
        $this->authorize('update',$tipoCuenta);
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        $request->validate([
            'codigo'=>'required|string|max:255|unique:tipo_cuentas,codigo,'.$tipoCuenta->id,
            'nombre'=>'required|string|max:255|unique:tipo_cuentas,nombre,'.$tipoCuenta->id,
            'valor_apertura'=>'required|regex:'.$rg_decimal.'|gte:0',
            'valor_debito'=>'required|regex:'.$rg_decimal.'|lte:valor_apertura',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'descripcion'=>'nullable|string|max:255'
        ]);

        $tipoCuenta->update($request->all());
        Session::flash('success','Tipo de cuenta actualizado');
        return redirect()->route('tipo-cuentas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoCuenta $tipoCuenta)
    {
        $this->authorize('delete',$tipoCuenta);
        try {
            $tipoCuenta->delete();
            Session::flash('success','Tipo de cuenta eliminado.!');
        } catch (\Throwable $th) {
            Session::flash('info','Tipo de cuenta no eliminado.!');
        }
        return redirect()->route('tipo-cuentas.index');
    }
}
