<?php

namespace App\Http\Controllers;

use App\DataTables\Credito\CuentaUserDataTable;
use App\DataTables\Credito\GaranteDataTable;
use App\DataTables\CreditoDataTable;
use App\Http\Requests\Credito\RqStore;
use App\Http\Requests\Credito\RqUpdate;
use App\Models\Credito;
use App\Models\TablaCredito;
use App\Models\TipoCredito;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class CreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ADMINISTRADOR|SECRETARIA']);
    }
    public function index(CreditoDataTable $dataTable)
    {
        return $dataTable->render('creditos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CuentaUserDataTable $dataTable)
    {
        $data = array(
            'tipo_creditos' => TipoCredito::where('estado','ACTIVO')->where('tipo','CREDITO')->get(),
            'fecha_pago'=>Carbon::today()->format('Y-m-d')
         );
        return $dataTable->render('creditos.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RqStore $request)
    {   
        $tipo_credito=TipoCredito::where('tasa_efectiva_anual',$request->tipo_credito)->firstOrFail();
        $request['tipo_credito_id']=$tipo_credito->id;
        $request['cuenta_user_id']=$request->cuenta_user;
        $request['fecha_vencimiento']=Carbon::parse($request->dia_pago)->addMonths($request->numero_cuotas);
        try {
            DB::beginTransaction();
            $credito=Credito::create($request->except(['cuenta_user','tipo_credito']));
            foreach ($request->numero_pago_tabla as $npt) {
                $tabla = array(
                    'numero_pago'=>$npt,
                    'fecha_pago'=>$request->fecha_pago_tabla[$npt],
                    'pago_mensual'=>$request->pago_mensual_tabla[$npt],
                    'interes'=>$request->interes_tabla[$npt],
                    'total_de_pago'=>$request->total_de_pago_tabla[$npt],
                    'saldo_capital'=>$request->saldo_capital_tabla[$npt],
                    'total'=>$request->total_pago_tabla[$npt],
                    'credito_id'=>$credito->id
                );
                TablaCredito::create($tabla);
            }
           
            DB::commit();
            Session::flash('success','Crédito ingresado exitosamente');
            return redirect()->route('creditos.show',$credito);
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Crédito no ingresado.!');
            return redirect()->back()->withInput();
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Credito $credito)
    {
        
        return view('creditos.show',['credito'=>$credito]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CuentaUserDataTable $dataTable,Credito $credito)
    {
        $this->authorize('editar',$credito);
        $data = array(
            'tipo_creditos' => TipoCredito::where('estado','ACTIVO')->where('tipo','CREDITO')->get(),
            'fecha_pago'=>Carbon::today()->format('Y-m-d'),
            'credito'=>$credito
         );
        return $dataTable->render('creditos.edit',$data);
    }
  

    /**
     * Update the specified resource in storage.
     */
    public function update(RqUpdate $request, Credito $credito)
    {
        $this->authorize('editar',$credito);
        $tipo_credito=TipoCredito::where('tasa_efectiva_anual',$request->tipo_credito)->firstOrFail();
        $request['tipo_credito_id']=$tipo_credito->id;
        $request['cuenta_user_id']=$request->cuenta_user;
        $request['fecha_vencimiento']=Carbon::parse($request->dia_pago)->addMonths($request->numero_cuotas);
        try {
            DB::beginTransaction();
            $credito->update($request->except(['cuenta_user','tipo_credito']));
            $credito->tablaCreditos()->delete();
            foreach ($request->numero_pago_tabla as $npt) {
                $tabla = array(
                    'numero_pago'=>$npt,
                    'fecha_pago'=>$request->fecha_pago_tabla[$npt],
                    'pago_mensual'=>$request->pago_mensual_tabla[$npt],
                    'interes'=>$request->interes_tabla[$npt],
                    'total_de_pago'=>$request->total_de_pago_tabla[$npt],
                    'saldo_capital'=>$request->saldo_capital_tabla[$npt],
                    'total'=>$request->total_pago_tabla[$npt],
                    'credito_id'=>$credito->id
                );
                TablaCredito::create($tabla);
            }

            DB::commit();
            Session::flash('success','Crédito actualizado exitosamente');
            return redirect()->route('creditos.show',$credito);
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Crédito no actualizado.!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credito $credito)
    {
        $this->authorize('eliminar',$credito);
        try {
            $credito->tablaCreditos()->delete();
            $credito->delete();
            Session::flash('success','Crédito eliminado exitosamente.');
            return redirect()->route('creditos.index');
        } catch (\Throwable $th) {
            Session::flash('info','Crédito no eliminado.');
            return redirect()->route('creditos.show',$credito->id);
        }
    }

    public function garantes(GaranteDataTable $dataTable, $creditoId)
    {
        $credito=Credito::findOrFail($creditoId);
        $data = array('credito' => $credito );
        return $dataTable->with('idCredito',$creditoId)->render('creditos.garantes',$data);
    }

    public function garantesActualizar(Request $request)
    {
        $request->validate([
            'credito'=>'nullable|exists:creditos,id',
            'garantes'=>'nullable|array',
            'garantes.*credito_id'=>'nullable|exists:users,id'
        ]);
        $credito=Credito::findOrFail($request->credito);
        $this->authorize('asignarGarantes', $credito);
        $credito->garantes()->sync($request->garantes);
        return redirect()->route('creditos.garantes',$credito);
    }


    public function tablaAmortizacion($creditoId)
    {
        $credito=Credito::findOrFail($creditoId);
      
        
        $title='TABLA DE AMORTIZACIÓN CRÉDITO';
        $headerHtml = view()->make('pdf.header',['title'=>$title])->render();
        $footerHtml = view()->make('pdf.footer')->render();
        $data = array(
            'credito'=>$credito,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('creditos.tabla-mortizacion', $data)
        ->setOption('header-spacing', '2')
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($title );
    }

    public function pagare($creditoId)
    {
        $credito=Credito::findOrFail($creditoId);
      
        
        $title='PAGARE A LA ORDEN';
        $headerHtml = view()->make('pdf.header',['title'=>$title])->render();
        $footerHtml = view()->make('pdf.footer')->render();
        $data = array(
            'credito'=>$credito,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('creditos.pagare', $data)
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($title );
    }

    public function actualizarEstado(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:creditos,id',
            'estado'=>'required'
        ]);

        $credito=Credito::find($request->id);
        
        
        $credito->estado=$request->estado;
        switch ($credito->estado) {
            case 'APROBADO':
                $credito->fecha_aprobado=Carbon::now();
                break;
            case 'REPROBADO':
                $credito->fecha_reprobado=Carbon::now();
                break;
            case 'PAGADO':
                $credito->fecha_pagado=Carbon::now();
                break;
            case 'PRECANCELADO':
                $credito->fecha_precancelado=Carbon::now();
                break;
            case 'VENCIDO':
                $credito->fecha_vencido=Carbon::now();
                break;
            case 'ENTREGADO':
                $credito->fecha_entregado=Carbon::now();
                break;
            default:
                break;
        }
        $credito->save();
        Session::flash('success','Crédito # '.$credito->numero.' cambiado estado a: '.$credito->estado);
        return redirect()->route('creditos.show', $credito->id);
    }
}
