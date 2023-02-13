<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;


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

    //Registrar Garantia
     Route::get('/garantia', function () {
        return view('garantias.garantias');
    })->name('garantia');

    //Registrar Pago
    Route::get('/pagos', function () {
        return view('prestamos.pagos');
    })->name('pagos');

 });

