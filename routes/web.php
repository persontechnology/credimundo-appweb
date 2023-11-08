<?php

use App\Http\Controllers\CajaController;
use App\Http\Controllers\CheckTwoFactorCotroller;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\CuentaUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MisCreditosController;
use App\Http\Controllers\MisCuentasController;
use App\Http\Controllers\PlazoFijoController;
use App\Http\Controllers\TipoCreditoController;
use App\Http\Controllers\TipoCuentaController;
use App\Http\Controllers\TipoTransaccionController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Artisan::call('cache:clear');
    // Artisan::call('config:clear');
    // Artisan::call('config:cache');
    // Artisan::call('storage:link');
    // Artisan::call('key:generate');
    // Artisan::call('migrate:fresh --seed');
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('check2fa', [CheckTwoFactorCotroller::class, 'index'])->name('check2fa.index');
Route::post('check2fa', [CheckTwoFactorCotroller::class, 'crear'])->name('check2fa.crear');
Route::get('check2fa/reenviar', [CheckTwoFactorCotroller::class, 'reenviar'])->name('check2fa.reenviar');




Route::middleware(['auth', 'verified','2fa'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::post('validarec', [HomeController::class, 'validarec'])->name('validarec');
    Route::get('/mi-perfil', [HomeController::class, 'miPerfil'])->name('mi-perfil');
    Route::post('/actualizar-contrasena', [HomeController::class, 'actualizarContrasena'])->name('actualizar-contrasena');
    


    // usuarios
    Route::resource('usuarios', UserController::class);
    Route::get('usuarios/identificacion-foto/{id}', [UserController::class,'identificacionFoto'])->name('usuarios.identificacion-foto');
    Route::post('usuarios/actualizar-identificacion-foto', [UserController::class,'actualizarIdentificacionFoto'])->name('usuarios.actualizar-identificacion-foto');
    Route::get('usuarios/ver-archivo/{id}/{tipo}', [UserController::class,'verArchivo'])->name('usuarios.ver-archivo');
    Route::get('usuarios/descargar-archivo/{id}/{tipo}', [UserController::class,'descargarArchivo'])->name('usuarios.descargar-archivo');

    // tipo de cuentas
    Route::resource('tipo-cuentas', TipoCuentaController::class);
    // tipoo de transaciones
    Route::resource('tipo-transacciones', TipoTransaccionController::class);
    // cuentas-usuarios
    Route::get('cuentas-usuario/imprimir-libreta-pdf',[CuentaUserController::class,'imprimirLibretaPdf'])->name('cuentas-usuario.imprimir-libreta-pdf');
    Route::resource('cuentas-usuario', CuentaUserController::class);
    Route::get('cuentas-usuario/solicitud-apertura-cuenta/{id}',[CuentaUserController::class,'solicitudAperturaCuenta'])->name('cuentas-usuario.solicitud-apertura-cuenta');
    Route::get('cuentas-usuario/transacciones-pdf/{id}',[CuentaUserController::class,'transaccionesPdf'])->name('cuentas-usuario.transacciones-pdf');
    Route::post('cuentas-usuario/actualizar-estado',[CuentaUserController::class,'actualizarEstado'])->name('cuentas-usuario.actualizar-estado');
    Route::post('cuentas-usuario/guardar-transaccion',[CuentaUserController::class,'guardarTransaccion'])->name('cuentas-usuario.guardar-transacion');
    Route::get('cuentas-usuario/imprimir-recibo/{idTrans}', [CuentaUserController::class,'imprimirRecibo'])->name('cuentas-usuario.imprimirRecibo');
    Route::get('cuentas-usuario/imprimir-comprobante/{idTrans}', [CuentaUserController::class,'imprimirComprobante'])->name('cuentas-usuario.imprimirComprobante'); 
    Route::get('cuentas-usuario/anular-transaccion/{idTrans}', [CuentaUserController::class,'anularTransaccion'])->name('cuentas-usuario.anularTransaccion'); 
    Route::post('cuentas-usuario/anular-transaccion-guardar', [CuentaUserController::class,'anularTransaccionGuardar'])->name('cuentas-usuario.anularTransaccionGuardar'); 
    Route::get('cuentas-usuario/transaciones/{id}',[CuentaUserController::class,'transacciones'])->name('cuentas-usuario-transaciones');
    
    
    
    // transacciones
    Route::resource('transacciones', TransaccionController::class);
    Route::get('transacciones/imprimir-recibo/{id}', [TransaccionController::class,'imprimirRecibo'])->name('transacciones.imprimirRecibo');
    Route::get('transacciones/imprimir-comprobante/{id}', [TransaccionController::class,'imprimirComprobante'])->name('transacciones.imprimirComprobante');

    // tipo de credito
    Route::resource('tipo-creditos', TipoCreditoController::class);

    // creditos
    Route::resource('creditos', CreditoController::class);
    Route::post('creditos/actualizar-estado', [CreditoController::class,'actualizarEstado'])->name('creditos.actualizar-estado');
    Route::get('creditos/tabla-amortizacion/{id}', [CreditoController::class,'tablaAmortizacion'])->name('creditos.tabla-amortizacion');
    Route::get('creditos/pagare/{id}', [CreditoController::class,'pagare'])->name('creditos.pagare');
    Route::get('creditos/seguro-credito/{id}', [CreditoController::class,'seguroCredito'])->name('creditos.seguro-credito');
    Route::get('creditos/garantes/{id}', [CreditoController::class,'garantes'])->name('creditos.garantes');
    Route::post('creditos/garantes/actualizar', [CreditoController::class,'garantesActualizar'])->name('creditos.garantes-actualizar');
    Route::post('creditos/tabla-credito-pagar', [CreditoController::class,'tablaCreditoPagar'])->name('creditos.tabla-credito-pagar');

    // plazo fijo
    Route::resource('plazo-fijo', PlazoFijoController::class);
    Route::post('plazo-fijo/actualizar-estado', [PlazoFijoController::class,'actualizarEstado'])->name('plazo-fijo.actualizar-estado');
    Route::get('plazo-fijo/tabla-amortizacion/{id}', [PlazoFijoController::class,'tablaAmortizacion'])->name('plazo-fijo.tabla-amortizacion');
    Route::get('plazo-fijo/certificadopf/{id}', [PlazoFijoController::class,'certificadopf'])->name('plazo-fijo.certificadopf');

    // caja
    Route::resource('caja', CajaController::class);



    // PARA EL SOSIO
    // mis cuentas
    Route::get('mis-cuentas',[MisCuentasController::class,'index'])->name('mis-cuentas');
    Route::post('enviar-mas-movimietos-correo',[MisCuentasController::class,'enviarMasMovimientoCorreo'])->name('enviar-mas-movimietos-correo');
    // mis creditos
    Route::get('mis-creditos',[MisCreditosController::class,'index'])->name('mis-creditos');
    




});