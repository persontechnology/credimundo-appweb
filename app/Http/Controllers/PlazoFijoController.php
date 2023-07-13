<?php

namespace App\Http\Controllers;

use App\DataTables\PlazoFijo\CuentaUserDataTable;
use App\DataTables\PlazoFijo\UserDataTable;
use App\DataTables\PlazoFijoDataTable;
use App\Http\Requests\PlazoFijo\RqStore;
use App\Http\Requests\PlazoFijo\RqUpdate;
use App\Models\Credito;
use App\Models\CuentaUser;
use App\Models\PlazoFijo;
use App\Models\TablaPlazoFijo;
use App\Models\TipoCredito;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class PlazoFijoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ADMINISTRADOR|SECRETARIA']);
    }
    public function index(PlazoFijoDataTable $dataTable)
    {
        return $dataTable->render('plazo-fijo.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CuentaUserDataTable $dataTable)
    {
        $data = array(
            'tipo_creditos' => TipoCredito::where('estado','ACTIVO')->where('tipo','PLAZO FIJO')->get(),
            'fecha_pago'=>Carbon::today()->format('Y-m-d')
         );
        return $dataTable->render('plazo-fijo.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RqStore $request)
    {
        
        $tipo_credito=TipoCredito::where('tasa_efectiva_anual',$request->tipo_credito)->firstOrFail();
        $credito=Credito::where('numero',$request->numero_credito)->first();

        if($credito){
            $request['credito_id']=$credito->id;
        }
        $request['tipo_credito_id']=$tipo_credito->id;
        $request['cuenta_user_id']=$request->cuenta_user;
        $request['fecha_vencimiento']=Carbon::parse($request->dia_pago)->addMonths($request->numero_cuotas);
        
        try {
            DB::beginTransaction();
            $plazo_fijo=PlazoFijo::create($request->except(['cuenta_user','tipo_credito']));
            foreach ($request->numero_pago_tabla as $npt) {
                $tabla = array(
                    'numero_pago'=>$npt,
                    'fecha_pago'=>$request->fecha_pago_tabla[$npt],
                    'pago_mensual'=>$request->pago_mensual_tabla[$npt],
                    'interes'=>$request->interes_tabla[$npt],
                    'total_de_pago'=>$request->total_de_pago_tabla[$npt],
                    'saldo_capital'=>$request->saldo_capital_tabla[$npt],
                    'total'=>$request->total_pago_tabla[$npt],
                    'plazo_fijo_id'=>$plazo_fijo->id,
                    
                );
                TablaPlazoFijo::create($tabla);
            }
            
            DB::commit();
            Session::flash('success','Certificado plazo fijo ingresado exitosamente');
            return redirect()->route('plazo-fijo.show',$plazo_fijo);
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Certificado plazo fijo no ingresado.!'.$th->getMessage());
            return redirect()->back()->withInput();
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(PlazoFijo $plazoFijo)
    {
        return view('plazo-fijo.show',['plazoFijo'=>$plazoFijo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CuentaUserDataTable $dataTable,PlazoFijo $plazoFijo)
    {
        // $this->authorize('editar',$plazoFijo);
        $data = array(
            'tipo_creditos' => TipoCredito::where('estado','ACTIVO')->where('tipo','PLAZO FIJO')->get(),
            'fecha_pago'=>Carbon::today()->format('Y-m-d'),
            'plazoFijo'=>$plazoFijo
         );
        return $dataTable->render('plazo-fijo.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RqUpdate $request, PlazoFijo $plazoFijo)
    {
        // $this->authorize('editar',$plazoFijo);

        $tipo_credito=TipoCredito::where('tasa_efectiva_anual',$request->tipo_credito)->firstOrFail();
        
        if($request->numero_credito){
            $credito=Credito::where('numero',$request->numero_credito)->first();
            if($credito){
                $request['credito_id']=$credito->id;
            }
        }else{
            $request['credito_id']=null;
        }

        
        $request['tipo_credito_id']=$tipo_credito->id;
        $request['cuenta_user_id']=$request->cuenta_user;
        $request['fecha_vencimiento']=Carbon::parse($request->dia_pago)->addMonths($request->numero_cuotas);
        
        try {
            DB::beginTransaction();
            $plazoFijo->update($request->except(['cuenta_user','tipo_credito']));
            $plazoFijo->tablaPlazoFijo()->delete();
            foreach ($request->numero_pago_tabla as $npt) {
                $tabla = array(
                    'numero_pago'=>$npt,
                    'fecha_pago'=>$request->fecha_pago_tabla[$npt],
                    'pago_mensual'=>$request->pago_mensual_tabla[$npt],
                    'interes'=>$request->interes_tabla[$npt],
                    'total_de_pago'=>$request->total_de_pago_tabla[$npt],
                    'saldo_capital'=>$request->saldo_capital_tabla[$npt],
                    'total'=>$request->total_pago_tabla[$npt],
                    'plazo_fijo_id'=>$plazoFijo->id,
                    
                );
                TablaPlazoFijo::create($tabla);
            }
            
            DB::commit();
            Session::flash('success','Certificado plazo fijo actualizado exitosamente');
            return redirect()->route('plazo-fijo.show',$plazoFijo);
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Certificado plazo fijo no actualizado.!'.$th->getMessage());
            return redirect()->back()->withInput();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlazoFijo $plazoFijo)
    {
        $this->authorize('eliminar',$plazoFijo);
        try {
            $plazoFijo->tablaPlazoFijo()->delete();
            $plazoFijo->delete();
            Session::flash('success','Certificado plazo fijo eliminado exitosamente.');
            return redirect()->route('plazo-fijo.index');
        } catch (\Throwable $th) {
            Session::flash('info','Certificado plazo fijo no eliminado.');
            return redirect()->route('plazo-fijo.show',$plazoFijo->id);
        }
    }

    public function actualizarEstado(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:plazo_fijos,id',
            'estado'=>'required'
        ]);

        $plazoFijo=PlazoFijo::find($request->id);
        
        
        $plazoFijo->estado=$request->estado;
        switch ($plazoFijo->estado) {
            case 'APROBADO':
                $plazoFijo->fecha_aprobado=Carbon::now();
                break;
            case 'REPROBADO':
                $plazoFijo->fecha_reprobado=Carbon::now();
                break;
            case 'PAGADO':
                $plazoFijo->fecha_pagado=Carbon::now();
                break;
            case 'PRECANCELADO':
                $plazoFijo->fecha_precancelado=Carbon::now();
                break;
            case 'VENCIDO':
                $plazoFijo->fecha_vencido=Carbon::now();
                break;
            case 'ENTREGADO':
                $plazoFijo->fecha_entregado=Carbon::now();
                break;
            default:
                break;
        }
        $plazoFijo->save();
        Session::flash('success','Plazo fijo # '.$plazoFijo->numero.' actualizado estado a: '.$plazoFijo->estado);
        return redirect()->route('plazo-fijo.show', $plazoFijo->id);
    }

    public function tablaAmortizacion($creditoId)
    {
        $plazoFijo=PlazoFijo::findOrFail($creditoId);
      
        
        $title='TABLA DE AMORTIZACIÓN CERTIFCADO PLAZO FIJO';
        $headerHtml = view()->make('pdf.header',['title'=>$title])->render();
        $footerHtml = view()->make('pdf.footer')->render();
        $data = array(
            'plazoFijo'=>$plazoFijo,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('plazo-fijo.tabla-mortizacion', $data)
        ->setOption('header-spacing', '2')
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($title );
    }

    public function certificadopf($plazoFijoId) {
        $plazoFijo=PlazoFijo::findOrFail($plazoFijoId);
      
        
        $title='CERTIFICADO DEPOSITO PLAZO FIJO';
        $headerHtml = view()->make('pdf.header',['title'=>$title])->render();
        $footerHtml = view()->make('pdf.footer')->render();
        $data = array(
            'plazoFijo'=>$plazoFijo,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('plazo-fijo.certificadopf', $data)
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($title );
    }
}
