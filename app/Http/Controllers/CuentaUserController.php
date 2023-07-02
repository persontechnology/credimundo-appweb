<?php

namespace App\Http\Controllers;

use App\DataTables\CuentaUser\UserDataTable;
use App\DataTables\CuentaUserDataTable;
use App\Models\CuentaUser;
use App\Models\TipoCuenta;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use PDF;

class CuentaUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ADMINISTRADOR|SECRETARIA']);
    }
    public function index(CuentaUserDataTable $dataTable)
    {
        return $dataTable->render('cuentas-usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(UserDataTable $dataTable)
    {
        $data = array('tipoCuentas' => TipoCuenta::where('estado','ACTIVO')->get() );
        return $dataTable->render('cuentas-usuario.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $request->validate([
            'userid'=>[
                'required',
                Rule::exists('users','id')->where('estado','ACTIVO')
            ],
            'descripcion'=>'nullable|string|max:255',
            'tipoCuenta'=>[
                'required',
                Rule::unique('cuenta_users','tipo_cuenta_id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->userid)->where('tipo_cuenta_id',$request->tipoCuenta);
                })
            ]
        ]);

        $tc=TipoCuenta::findOrFail($request->tipoCuenta);
        $data = array(
            'valor_apertura'=>$tc->valor_apertura,
            'valor_debito'=>$tc->valor_debito,
            'valor_disponible'=>0,
            'estado'=>'CREADO',
            'descripcion'=>$request->descripcion,
            'user_id'=>$request->userid,
            'tipo_cuenta_id'=>$tc->id,
        );
        
        try {
            $user=CuentaUser::create($data);
            Session::flash('success','Cuenta ingresado');
            return redirect()->route('cuentas-usuario.show',$user->id);
        } catch (\Throwable $th) {
            Session::flash('warning','Cuenta no ingresado'.$th->getMessage());
            return redirect()->back()->withInput();
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show($cuentaUserId)
    {
        $cuentaUser=CuentaUser::findOrFail($cuentaUserId);
        $listado=$cuentaUser->transacciones()->orderBy('id','desc')->take(112)->get();
        $data = array(
            'transacciones' => $listado,
            'cuentaUser'=>$cuentaUser
        );
        return view('cuentas-usuario.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserDataTable $dataTable, $cuentaUserId)
    {
        $cuentaUser=CuentaUser::findOrFail($cuentaUserId);
        $data = array(
            'cuentaUser' => $cuentaUser,
            'tipoCuentas'=> TipoCuenta::where('estado','ACTIVO')->get()
        );
        return $dataTable->render('cuentas-usuario.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cuentaUserId)
    {
       $cuentaUser=CuentaUser::findOrFail($cuentaUserId);
        $request->validate([
            'userid'=>[
                'required',
                Rule::exists('users','id')->where('estado','ACTIVO')
            ],
            'estado'=>'required|in:CREADO,ACTIVO,INACTIVO',
            'descripcion'=>'nullable|string|max:255',
            'tipoCuenta'=>[
                'required',
                Rule::unique('cuenta_users','tipo_cuenta_id')->where(function ($query) use ($request,$cuentaUser) {
                    return $query->where('user_id', $request->userid)
                    ->where('tipo_cuenta_id',$request->tipoCuenta)
                    ->where('id','!=',$cuentaUser->id);
                })
            ]
        ]);

        $data = array(
            'estado'=>$request->estado,
            'descripcion'=>$request->descripcion,
            'user_id'=>$request->userid,
            'tipo_cuenta_id'=>$request->tipoCuenta,
        );
        $cuentaUser->update($data);

        Session::flash('success','Cuenta de usuario actualizado.!');
        return redirect()->route('cuentas-usuario.show',$cuentaUser->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cuentaUser=CuentaUser::findOrFail($id);
        try {
            $cuentaUser->delete();
            Session::flash('success','Cuenta de usuario eliminado');
        } catch (\Throwable $th) {
            Session::flash('info','Cuenta de usuario no eliminado');
        }
        return redirect()->route('cuentas-usuario.index');
    }

    public function solicitudAperturaCuenta($cuentaUserId)
    {
        $cuentaUser=CuentaUser::findOrFail($cuentaUserId);
        $title='SOLICITUD APERTURA DE CUENTA';
        $headerHtml = view()->make('pdf.header',['title'=>$title])->render();
        $footerHtml = view()->make('pdf.footer')->render();
        $data = array(
            'cuentaUser'=>$cuentaUser,
            'user'=>$cuentaUser->user,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('cuentas-usuario.solicitu-apertura-cuenta', $data)
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($title );
        
    }

    public function actualizarEstado(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:cuenta_users,id',
            'estado'=>'required|in:ACTIVO,INACTIVO'
        ]);
        $cuentaUser=CuentaUser::findOrFail($request->id);
        $cuentaUser->estado=$request->estado;
        $cuentaUser->save();
        Session::flash('success','Cuenta de usuario actualizado a '.$cuentaUser->estado);
        return redirect()->route('cuentas-usuario.show',$cuentaUser->id);
    }

    public function imprimirLibretaPdf(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:cuenta_users,id',
            'numero'=>'required|numeric|gte:0'
        ]);
        $cuentaUser=CuentaUser::findOrFail($request->id);
        
        $fila_inicial=1;
        switch ($request->numero) {
            case $request->numero===0:
                return $this->imprimirEncabezadoLibreta($cuentaUser);
                break;
            case $request->numero<=27:
                $fila_inicial=1;
                break;
            case $request->numero<=58:
                $fila_inicial=28;
                break;
            case $request->numero<=89:
                $fila_inicial=59;
                break;
            case $request->numero<=120:
                $fila_inicial=90;
                break;
            default:
                return 'no existe hoja';
                break;
        }
        return $this->imprimirDetalleLibreta($cuentaUser,$request->numero,$fila_inicial);
        
    }

    public function imprimirDetalleLibreta($cuentaUser,$numero,$fila_inicial)
    {
        $listado=$cuentaUser->transacciones()->orderBy('id','desc')->take(112)->get();
       
        $collection = collect($listado);
       
         $xNumeroLibreta= $collection->firstWhere('numero_libreta', $numero);

        if($xNumeroLibreta){
            
            $filtered = $collection->where('id','>=', $xNumeroLibreta->id)->reverse();

            $data = array(
                'transacciones' => $filtered->all(),
                'numero'=>$numero,
                'fila_inicial'=>$fila_inicial
            );  
            
            $pdf = PDF::loadView('cuentas-usuario.libreta-transacciones-pdf', $data)
            ->setOption('margin-top', 17)
            ->setOption('margin-bottom', 7)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 5)
            ->setOption('page-width', '91')
            ->setOption('page-height', '155');
            return $pdf->inline('Libreta');
            

        }else{
            return 'Número de libreta no existe';
        }
        
    }


    public function imprimirEncabezadoLibreta($cuentaUser)
    {
        $data_encabezado = array(
            'cuentaUser'=>$cuentaUser
        );
        $pdf_encabezado = PDF::loadView('cuentas-usuario.libreta-datos-pdf', $data_encabezado)
        ->setOption('margin-top', 16)
        ->setOption('page-width', '91')
        ->setOption('page-height', '296');
        return $pdf_encabezado->inline('Libreta');
    }
}
