<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    public function index(){

        $permisos = Permission::select('id','name')->get();

        return view('Seguridad/Permisos',compact('permisos'));
    }
}
