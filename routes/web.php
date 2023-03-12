<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\InteresController;
use App\Http\Controllers\ModoPagoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


 Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/crearclientes', function () {
        return view('crearclientes');
    })->name('crearclientes');

    Route::get('/crearusuario', function () {
        return view('usuarios.crearusuarios');
    })->name('crearusuario');
    Route::post('/guardarusuario', [UsersController::class,'create'])->name('user.create');

    //usuarios
    Route::get('/actualizarusuario/{id}',[UsersController::class,'edit'])->name('user.editarusuarios');
    Route::get('/editarusuario/{id}', [UsersController::class,'update'])->name('user.update');
    Route::get('/eliminarusuarios/{id}',[UsersController::class,'destroy'])->name('user.eliminarusuarios');

    //clientes
    Route::post('/clientes/crearclientes',[App\Http\Controllers\ClienteController::class,'create'])->name('clientes.crearclientes');
    Route::get('/clientes/show',[App\Http\Controllers\ClienteController::class,'show'])->name('clientes.show');

    Route::post('/clientes',[App\Http\Controllers\ClienteController::class,'index'])->name('clientesv');
    Route::get('/clientes',[App\Http\Controllers\ClienteController::class,'store'])->name('clientesv');

    Route::get('/usersv', [UsersController::class,'index'])->name('usersv');
    Route::post('/usersv', [UsersController::class,'store'])->name('usersv');
    Route::get('/clientesv', [ClienteController::class,'index'])->name('clientesv');
    Route::post('/clientesv', [ClienteController::class,'store'])->name('clientesv');

    //editar clientes
    Route::get('/actualizarclientes/{id}',[ClienteController::class,'edit'])->name('clientes.editarclientes');
    Route::get('/editarclientes/{id}', [ClienteController::class,'update'])->name('clientes.update');
    Route::get('/eliminarclientes/{id}',[ClienteController::class,'destroy'])->name('clientes.eliminarclientes');

    //Registrar nuevo Prestamo
     Route::get('/nuevoprestamo', function () {
        return view('prestamos.nuevoprestamo');
    })->name('nuevoprestamo');
    Route::resource('prestamos', PrestamoController::class);


    Route::get('/prestamos', [App\Http\Controllers\PrestamoController::class, 'index'])->name('prestamos.index');
    Route::get('/prestamos/create', [App\Http\Controllers\PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('/prestamos', [App\Http\Controllers\PrestamoController::class, 'store'])->name('prestamos.store');
    Route::get('/prestamos/{prestamo}', [App\Http\Controllers\PrestamoController::class, 'show'])->name('prestamos.show');
    Route::get('/prestamos/{prestamo}/edit', [App\Http\Controllers\PrestamoController::class, 'edit'])->name('prestamos.edit');
    Route::put('/prestamos/{prestamo}', [App\Http\Controllers\PrestamoController::class, 'update'])->name('prestamos.update');
    Route::delete('/prestamos/{prestamo}', [App\Http\Controllers\PrestamoController::class, 'destroy'])->name('prestamos.destroy');

    //Registrar Garantia
     Route::get('/garantia', function () {
        return view('garantias.garantias');
    })->name('garantia');

    //Registrar Pago
    Route::get('/pagos', function () {
        return view('prestamos.pagos');
    })->name('pagos');

    //Registrar Interes
    Route::get('/interests', [InteresController::class, 'index'])->name('interests.index');
    Route::get('/interests/create', [InteresController::class, 'create'])->name('interests.create');
    Route::post('/interests', [InteresController::class, 'store'])->name('interests.store');


    Route::get('/test', function () {
        return view('interests.create');
    });

    //Modos de Pagos
    Route::get('/modo_pago', [App\Http\Controllers\ModoPagoController::class, 'index'])->name('modos_pago.index');
    Route::get('/modo_pago/create', [App\Http\Controllers\ModoPagoController::class, 'create'])->name('modosPago.create');
    Route::post('/modo_pago', [App\Http\Controllers\ModoPagoController::class, 'store'])->name('modos_pago.store');
    Route::get('/modo_pago/{modo_pago}', [App\Http\Controllers\ModoPagoController::class, 'show'])->name('modos_pago.show');
    Route::get('/modo_pago/{modo_pago}/edit', [App\Http\Controllers\ModoPagoController::class, 'edit'])->name('modosPago.edit');
    Route::put('/modo_pago/{modo_pago}', [App\Http\Controllers\ModoPagoController::class, 'update'])->name('modos_pago.update');
    Route::delete('/modo_pago/{modo_pago}', [App\Http\Controllers\ModoPagoController::class, 'destroy'])->name('modosPago.destroy');



 });

