<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\InteresController;
use App\Http\Controllers\ModoPagoController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\GarantiaController;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\GananciasController;
use App\Http\Controllers\Seguridad;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Middleware\RoleMiddleware;





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
    'verified',


    ])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/permisos', [Seguridad\PermisosController::class,'index'])->name('permisos.index');
    Route::get('/roles', [Seguridad\RolesController::class,'index'])->name('roles.index');

    Route::get('/crearclientes', function () {
            return view('crearclientes');
        })->name('crearclientes');
    Route::get('/crearusuario', function () {
        return view('usuarios.crearusuarios');
    })->name('crearusuario');
    Route::post('/guardarusuario', [UsersController::class,'create'])->name('user.create');

    //usuarios
    Route::get('/actualizarusuario/{id}',[UsersController::class,'edit'])->name('user.editarusuarios');
    Route::match(['get', 'post'], '/editarusuario/{id}', [UsersController::class, 'update'])->name('user.update');
    Route::get('/eliminarusuarios/{id}',[UsersController::class,'destroy'])->name('user.eliminarusuarios');
    Route::get('/users', [UsersController::class, 'index'])->name('livewire.Users');
    Route::post('/user/cambiarEstado/{id}', [UsersController::class,'cambiarEstado'])->name('user.cambiarEstado');

    //Clientes
    Route::post('/clientes/crearclientes',[App\Http\Controllers\ClienteController::class,'create'])->name('clientes.crearclientes');
    Route::get('/clientes/show',[App\Http\Controllers\ClienteController::class,'show'])->name('clientes.show');
    Route::post('/buscar-clientes', [App\Http\Controllers\ClienteController::class,'buscarClientes'])->name('clientes.buscarClientes');
    Route::post('/clientes',[App\Http\Controllers\ClienteController::class,'index'])->name('clientesv');
    Route::get('/clientes',[App\Http\Controllers\ClienteController::class,'store'])->name('clientesv');
    Route::get('/clientes/mostrar/{criterio}', [ClienteController::class, 'mostrarCliente'])->name('clientes.mostrar');
    Route::post('/clientes', [ClienteController::class, 'buscarCliente'])->name('buscar.cliente');
    Route::get('/pdf/{cliente_id}', [PDFController::class, 'generatePDF'])->name('pdf.generate');
    Route::get('/clientes/obtenerdatoscliente', [ClienteController::class, 'obtenerDatosCliente'])->name('clientes.obtenerdatoscliente');

    //MostrarUsuarios
    Route::get('/usersv', [UsersController::class,'index'])->name('usersv');
    Route::post('/usersv', [UsersController::class,'store'])->name('usersv');
    Route::get('/clientesv', [ClienteController::class,'index'])->name('clientesv');
    Route::post('/clientesv', [ClienteController::class,'store'])->name('clientesv');

    //Editar Clientes
    Route::get('/actualizarclientes/{id}',[ClienteController::class,'edit'])->name('clientes.editarclientes');
    Route::post('/editarclientes/{id}', [ClienteController::class,'update'])->name('clientes.update');
    Route::get('/eliminarclientes/{id}',[ClienteController::class,'destroy'])->name('clientes.eliminarclientes');



    //Zona
    Route::resource('/zonas', ZonaController::class)->names([
        'index' => 'zonas.index',
        'create' => 'zonas.create',
        'store' => 'zonas.store',
        'show' => 'zonas.show',
        'edit' => 'zonas.edit',
        'update' => 'zonas.update',
        'destroy' => 'zonas.destroy',
    ]);
    Route::get('/clientes/zona', [ZonaController::class, 'create'])->name('zona.create');
    Route::get('zonas/{zona}/editar', [ZonaController::class, 'edit'])->name('zonas.edit');
    Route::get('zonas', [ZonaController::class, 'index'])->name('zonas.index');
    Route::get('buscar-zona/{cod_zona}', [ZonaController::class, 'buscarZona']);

   //CIUDAD
    Route::get('/ciudades', [App\Http\Controllers\CiudadController::class, 'index'])->name('ciudades.index');
    Route::post('/ciudades', [App\Http\Controllers\CiudadController::class, 'store'])->name('ciudades.store');
    Route::get('/ciudades/create', [App\Http\Controllers\CiudadController::class, 'create'])->name('ciudades.create');
    Route::get('/ciudades/{id}/edit', [App\Http\Controllers\CiudadController::class, 'edit'])->name('ciudades.edit');
    Route::put('/ciudades/{id}', [App\Http\Controllers\CiudadController::class, 'update'])->name('ciudades.update');

    //Registrar nuevo Prestamo
     Route::get('/nuevoprestamo', function () {
        return view('prestamos.nuevoprestamo');
    })->name('nuevoprestamo');
    Route::resource('prestamos', PrestamoController::class);

    Route::get('/prestamos', [App\Http\Controllers\PrestamoController::class, 'index'])->name('prestamos.index');
    Route::get('/prestamos/create', [App\Http\Controllers\PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('/prestamos/store', [App\Http\Controllers\PrestamoController::class, 'store'])->name('prestamos.store');
    Route::get('/prestamos/{prestamo}', [App\Http\Controllers\PrestamoController::class, 'show'])->name('prestamos.show');
    Route::get('/prestamos/{prestamo}/edit', [App\Http\Controllers\PrestamoController::class, 'edit'])->name('prestamos.edit');
    Route::put('/prestamos/{prestamo}', [App\Http\Controllers\PrestamoController::class, 'update'])->name('prestamos.update');
    Route::delete('/prestamos/{prestamo}', [App\Http\Controllers\PrestamoController::class, 'destroy'])->name('prestamos.destroy');
    Route::get('/obtener-datos-prestamo', [PrestamoController::class, 'obtenerDatosPrestamografico'])->name('obtener_datos_prestamo');

    //Registrar Garantia
    Route::get('/garantias/index', [GarantiaController::class, 'index'])->name('garantias.index');
    Route::get('/garantias/create', [GarantiaController::class, 'create'])->name('garantias.create');
    Route::post('/garantias/store', [GarantiaController::class, 'store'])->name('garantias.store');
    Route::get('garantias/prestamos_by_cliente/{clienteId}', [GarantiaController::class, 'getPrestamosByCliente'])->name('garantias.prestamos_by_cliente');
    Route::delete('/garantias/{id}', [GarantiaController::class, 'destroy'])->name('garantias.destroy');
    Route::get('/garantias/{garantia}/edit', [GarantiaController::class, 'edit'])->name('garantias.edit');
    Route::put('/garantias/{garantia}', [GarantiaController::class, 'update'])->name('garantias.update');
    Route::get('/pdf/garantia/{garantia_id}', [PDFController::class, 'generatePDFgarantia'])->name('pdf.garantia');

    //PAGOS
    Route::get('/pagos/create', [PagoController::class, 'create'])->name('pagos.create');
    Route::post('/pagos/store', [PagoController::class, 'store'])->name('pagos.store');
    Route::get('/pagos/buscar/{id}', [PagoController::class, 'obtenerPorCliente'])->name('pagos.obtenerPorCliente');
    Route::get('/pagos/{id}', [PagoController::class, 'show'])->name('pagos.show');
    Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
    Route::get('/pagos/{id}/edit', [PagoController::class, 'edit'])->name('pagos.edit');
    Route::put('/pagos/{id}', [PagoController::class, 'update'])->name('pagos.update');
    Route::get('/pagos/buscar-pagos/{id}', [PagoController::class, 'obtenerPagosPorCliente'])->name('pagos.obtenerPagosPorCliente');
    Route::get('/clientes/{cliente_id}/pdf', [PDFController::class, 'generatePDFcliente'])->name('pdf.generatePDFcliente');
    Route::get('/obtener-datos-pagos-grafico', [PagoController::class, 'obtenerDatosPagosGrafico'])->name('obtener_datos_pagos_grafico');

    //Registrar Interes
    Route::get('/interests', [InteresController::class, 'index'])->name('interests.index');
    Route::get('/interests/create', [InteresController::class, 'create'])->name('interests.create');
    Route::post('/interests', [InteresController::class, 'store'])->name('interests.store');


    Route::get('/test', function () {
        return view('interests.create');
    });

    //Ganancias

    Route::get('/ganancia/create', [GananciasController::class, 'mostrarFormularioEfectivo'])->name('ganancia.create');
    Route::post('/ganancia/actualizar', [GananciasController::class, 'actualizarEfectivo'])->name('ganancia.actualizar');
    Route::get('/ganancia/calculomensual', [GananciasController::class, 'calcularGanancias'])->name('ganancia.calculomensual');
    Route::get('/ganancia/ganancias-mensuales', [GananciasController::class, 'calcularGananciasMes'])->name('ganancia.ganancias-mensuales');

    //Modos de Pagos
    Route::get('/modo_pago', [App\Http\Controllers\ModoPagoController::class, 'index'])->name('modos_pago.index');
    Route::get('/modo_pago/create', [App\Http\Controllers\ModoPagoController::class, 'create'])->name('modosPago.create');
    Route::post('/modo_pago', [App\Http\Controllers\ModoPagoController::class, 'store'])->name('modos_pago.store');
    Route::get('/modo_pago/{modo_pago}', [App\Http\Controllers\ModoPagoController::class, 'show'])->name('modos_pago.show');
    Route::get('/modo_pago/{modo_pago}/edit', [App\Http\Controllers\ModoPagoController::class, 'edit'])->name('modosPago.edit');
    Route::put('/modo_pago/{modo_pago}', [App\Http\Controllers\ModoPagoController::class, 'update'])->name('modos_pago.update');
    Route::delete('/modo_pago/{modo_pago}', [App\Http\Controllers\ModoPagoController::class, 'destroy'])->name('modosPago.destroy');

    //REPORTES
      //CLIENTES
      Route::get('/reportes/clientes-creados', function () {
        return view('reportes.clientescreados');
    })->name('reportes.clientescreados');

      //PRESTAMOS
      Route::get('/reportes/historial-prestamos', function () {
        return view('reportes.historialprestamos');
    })->name('reportes.historialprestamos');

      //GARANTIAS
      Route::get('/reportes/historial-garantias', function () {
        return view('reportes.historialgarantias');
    })->name('reportes.historialgarantias');

     //BITACORA
     Route::get('/reportes/movimientos-bitacora', function () {
        return view('reportes.movimientosbitacora');
    })->name('reportes.movimientosbitacora');

      //GANANCIAS
      Route::get('/reportes/ganancias', function () {
        return view('reportes.ganancias');
    })->name('reportes.ganancias');

    //GANANCIAS
    Route::get('/reportes/historialpagos', function () {
        return view('reportes.historialpagos');
    })->name('reportes.historialpagos');

      //POWERBI
      Route::get('/reportes/powerbi', function () {
        return view('reportes.powerbi');
    })->name('reportes.powerbi');




     //DASHBOARD
     Route::get('/dashboard', [ClienteController::class, 'dashboard'])->name('dashboard');
     Route::get('/dashboard/prestamos', [PrestamoController::class, 'clientesprestamo'])->name('dashboard.prestamos');
     Route::get('/dashboard/zonas', [ZonaController::class, 'obtenerZonas'])->name('dashboard.zonas');
     Route::get('/dashboard/modos-pago', [PrestamoController::class, 'obtenerRegistrosPorModoPago'])->name('dashboard.modos-pago');
     Route::get('/dashboard/estados-prestamos', [PrestamoController::class, 'obtenerEstadosPrestamos'])->name('dashboard.estados-prestamos');
     Route::get('/dashboard/estados-clientes', [ClienteController::class, 'obtenerEstadosClientes'])->name('dashboard.estados-clientes');
    //  Route::get('/dashboard/tarjeta', [PrestamoController::class, 'mostrarTarjeta'])->name('dashboard.tarjeta');


 });

