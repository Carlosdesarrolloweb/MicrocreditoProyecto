<?php


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
    return view('welcome');
});
Route::get('/register', function () {
    return view('auth.register');
})->name('register'); 

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
   
    Route::get('/usersv', [UsersController::class,'index'])->name('usersv');
 });

