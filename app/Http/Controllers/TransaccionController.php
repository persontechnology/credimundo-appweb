<?php

namespace App\Http\Controllers;

use App\DataTables\Transaccion\CuentaUserDataTable;
use App\DataTables\TransaccionDataTable;
use App\Http\Requests\Transaccion\StoreRq;
use App\Models\CuentaUser;
use App\Models\TipoTransaccion;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use PDF;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TransaccionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ADMINISTRADOR|SECRETARIA']);
    }
    public function index(TransaccionDataTable $dataTable)
    {   

        return $dataTable->render('transacciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CuentaUserDataTable $dataTable)
    {

        $data = array(
            'tipoTransacciones' => TipoTransaccion::where('estado','ACTIVO')->get(),
        );
        return $dataTable->render('transacciones.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRq $request)
    {
        
        $data = array(
            'valor'=>$request->valor,
            'estado'=>'OK',
            'detalle'=>$request->detalle,
            'cuenta_user_id'=>$request->cuentaUser,
            'tipo_transaccion_id'=>$request->tipoTransaccion,
            'quien_realiza_transaccion'=>$request->quienRealizaTransaccion,
            'identificacion_otra_persona'=>$request->identificacion_otra_persona,
            'nombre_otra_persona'=>$request->nombre_otra_persona,
        );
        try {
            DB::beginTransaction();
            $t=Transaccion::create($data);
            DB::commit();
            Session::flash('success','Transacción realizado');
            return redirect()->route('transacciones.show',$t);
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Transacción no realizado'.$th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($transaccionId)
    {
        $transaccion=Transaccion::findOrFail($transaccionId);
        $data = array(
            'trans' => $transaccion,
            'ultimos_trans'=>$transaccion->cuentaUser->transacciones()->where('id','<',$transaccion->id)->latest()->take(3)->get()
        );
        return view('transacciones.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($transaccionId)
    {
        $transaccion=Transaccion::findOrFail($transaccionId);

        $data = array(
            'trans' => $transaccion,
        );
        return view('transacciones.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $transaccionId)
    {
    
        $request->validate([
            'confirmacion'=>'required',
            'id'=>[
                'required',
                Rule::exists('transaccions','id')->where('estado', 'OK')
            ]
        ]);

        try {
            DB::beginTransaction();
            $t=Transaccion::findOrFail($transaccionId);
            if($t->estado=='OK'){
                switch ($t->tipoTransaccion->tipo) {
                    case 'RESTAR':
                        $t->cuentaUser->valor_disponible=$t->cuentaUser->valor_disponible+$t->valor;   
                        break;
                    case 'SUMAR':
                        $t->cuentaUser->valor_disponible=$t->cuentaUser->valor_disponible-$t->valor;   
                        break;
                    default:
                        # code...
                        break;
                }
                $t->cuentaUser->save();
                $t->valor_disponible=$t->cuentaUser->valor_disponible;
                $t->estado='ANULADO';
                $t->descripcion_estado=$request->detalle;
                $t->save();
                
                Session::flash('success','Transacción ANULADA.');
            }else{
                Session::flash('success','Transacción no actualizado ya que el estado es ANULADO.');
            }
            DB::commit();
            return redirect()->route('transacciones.show',$t);
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Transacción no actualizado'.$th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaccion $transaccion)
    {
        //
    }

    public function imprimirRecibo($transaccionId)
    {
        $transaccion=Transaccion::findOrFail($transaccionId);

        $data = array(
            'trans'=>$transaccion,
            'ultimos_trans'=>$transaccion->cuentaUser->transacciones()->where('id','<',$transaccion->id)->latest()->take(3)->get()
        );
        $pdf = PDF::loadView('transacciones.imprimir-recibo', $data)
        ->setOption('page-width', '80')
        ->setOption('page-height', '297')
        ->setOption('margin-top', 0)
        ->setOption('margin-bottom', 2)
        ->setOption('margin-left', 2)
        ->setOption('margin-right', 2);
        return $pdf->inline('Recibo N° '.$transaccion->numero);
    }

    public function imprimirComprobante($transaccionId)
    {
        $transaccion=Transaccion::findOrFail($transaccionId);
        $data = array(
            'trans'=>$transaccion,
            'ultimos_trans'=>$transaccion->cuentaUser->transacciones()->where('id','<',$transaccion->id)->latest()->take(3)->get()
        );
        $pdf = PDF::loadView('transacciones.imprimir-comprobante', $data)
        ->setOption('page-width', '91')
        ->setOption('page-height', '296')
        // ->setOrientation('landscape')
        ->setOption('margin-top', 5)
        ->setOption('margin-bottom', 0)
        ->setOption('margin-left', 2)
        ->setOption('margin-right', 2);
        return $pdf->inline('Comprobante N° '.$transaccion->numero);
    }
}
