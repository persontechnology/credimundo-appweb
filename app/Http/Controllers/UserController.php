<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\User\StoreRq;
use App\Http\Requests\User\UpdateRq;
use App\Http\Requests\User\UserRqStore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ADMINISTRADOR|SECRETARIA']);
    }
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('usuarios.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array('roles' => Role::whereNotIn('name',[config('app.ROLE_ADMIN')])->get() );
        return view('usuarios.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRq $request)
    {
        try {
            DB::beginTransaction();
            $user=User::create($request->except(['password']));
            
            if($request->password){
                $user->password=Hash::make($request->password);
                $user->save();
            }
            
            $user->assignRole($request->roles);
            
            DB::commit();
            Session::flash('success','Usuario guardado.');
            return redirect()->route('usuarios.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('danger','Ocurrio un error, vuelva intentar o consulte con administrador.'.$th->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::findOrFail($id);
        $this->authorize('update',$user);
        $data = array(
            'user' => $user,
            'roles'=>Role::whereNotIn('name',[config('app.ROLE_ADMIN')])->get()
        );

        return view('usuarios.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRq $request, string $id)
    {
        $user=User::findOrFail($id);
        $this->authorize('update',$user);
        try {
            DB::beginTransaction();
            $user->update($request->except(['password']));
            if($request->password){
                $user->password=Hash::make($request->password);
                $user->save();
            }
            
            if(!$user->hasRole(config('app.ROLE_ADMIN'))){
                $user->syncRoles($request->roles);
            }
                
            DB::commit();
            return redirect()->route('usuarios.index')->with('success','Usuario actualizado.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('danger','Ocurrio un error, vuelva intentar o consulte con administrador.'.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $this->authorize('delete',$user);
            if($user->delete()){
                Storage::delete($user->foto);
                Storage::delete($user->foto_identificacion);
            }
            Session::flash('success','Usuario eliminado.!');
        } catch (\Throwable $th) {
            Session::flash('info','Usuario no eliminado.!');
        }
        return redirect()->route('usuarios.index');
    }

    public function verArchivo($idUser,$tipo)
    {
        $user=User::findOrFail($idUser);
        switch ($tipo) {
            case 'foto':
                return Storage::get($user->foto);        
                break;
            case 'foto_identificacion':
                return Storage::get($user->foto_identificacion);        
                break;
            default:
                return '';
                break;
        }
    }
    public function descargarArchivo($idUser,$tipo)
    {
        $user=User::findOrFail($idUser);
        switch ($tipo) {
            case 'foto':
                return Storage::download($user->foto);        
                break;
            case 'foto_identificacion':
                return Storage::download($user->foto_identificacion);        
                break;
            default:
                return '';
                break;
        }
    }

    public function identificacionFoto($id)
    {
        $user=User::findOrFail($id);
        return view('usuarios.identificacion-foto',['user'=>$user]);
    }
    
    public function actualizarIdentificacionFoto(Request $request)
    {
        
        $user=User::findOrFail($request->id);
        if ($request->hasFile('foto') && $request->tipo==='foto') {
            if(Storage::exists($user->foto??'noexiste.pngx')){
                Storage::delete($user->foto);
            }
            $path = Storage::putFileAs(
                'users/fotos', $request->file('foto'), $user->id.'.'.$request->file('foto')->getClientOriginalExtension()
            );
            $user->foto=$path;
            $user->save();
        }

        if ($request->hasFile('foto_identificacion') && $request->tipo==='identificacion') {
            if(Storage::exists($user->foto_identificacion??'noexiste.pngx')){
                Storage::delete($user->foto_identificacion);
            }
            
            $path = Storage::putFileAs(
                'users/identificacion', $request->file('foto_identificacion'), $user->id.'.'.$request->file('foto_identificacion')->getClientOriginalExtension()
            );
            $user->foto_identificacion=$path;
            $user->save();
        }
        return json_encode(['success'=>'ok']);
    }
}
