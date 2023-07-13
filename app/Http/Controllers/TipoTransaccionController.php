<?php

namespace App\Http\Controllers;

use App\DataTables\TipoTransaccionDataTable;
use App\Models\TipoTransaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TipoTransaccionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ADMINISTRADOR']);
    }
    public function index(TipoTransaccionDataTable $dataTable)
    {
        return $dataTable->render('tipo-transacciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo-transacciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo'=>'required|string|max:255|unique:tipo_transaccions,codigo',
            'nombre'=>'required|string|max:255|unique:tipo_transaccions,nombre',
            'detalle'=>'nullable|string|max:255',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'tipo'=>'required|in:SUMAR,RESTAR',
            'descripcion'=>'nullable|string|max:255|',
        ]);
        TipoTransaccion::create($request->all());
        Session::flash('success','Tipo de transacción ingresado.');
        return redirect()->route('tipo-transacciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoTransaccion $tipoTransaccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipoTransaccion=TipoTransaccion::findOrFail($id);
        $this->authorize('update',$tipoTransaccion);
        return view('tipo-transacciones.edit',['tt'=>$tipoTransaccion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tipoTransaccion=TipoTransaccion::findOrFail($id);
        $this->authorize('update',$tipoTransaccion);
        $request->validate([
            'codigo'=>'required|string|max:255|unique:tipo_transaccions,codigo,'.$tipoTransaccion->id,
            'nombre'=>'required|string|max:255|unique:tipo_transaccions,nombre,'.$tipoTransaccion->id,
            'detalle'=>'nullable|string|max:255',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'tipo'=>'required|in:SUMAR,RESTAR',
            'descripcion'=>'nullable|string|max:255|',
        ]);
        
        $tipoTransaccion->update($request->all());
        Session::flash('success','Tipo de transacción actualizado.');
        return redirect()->route('tipo-transacciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipoTransaccion=TipoTransaccion::findOrFail($id);
        $this->authorize('delete',$tipoTransaccion);
        try {
            $tipoTransaccion->delete();
            Session::flash('success','Tipo de transacción eliminado.');
        } catch (\Throwable $th) {
            Session::flash('info','Tipo de transacción no eliminado.');
        }
        return redirect()->route('tipo-transacciones.index');
    }
}
