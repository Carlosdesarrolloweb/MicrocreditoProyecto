<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.users',['Users'=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $usuario = new User();

       
        $usuario->Carnet_usuario = $request->Carnet_usuario;
        $usuario->name=$request->name;
        $usuario->apellido_usuario=$request->apellido_usuario;
        $usuario->Nombre_usuario=$request->Nombre_usuario;
        $usuario->cargo_usuario =$request->cargo_usuario;
        $usuario->direccion_usuario =$request->direccion_usuario;
        $usuario->telefono_usuario=$request->telefono_usuario;
        $usuario-> email=$request->email;
        $usuario->password=$request->password;
        $usuario->save();
        return view('usuarios.crearusuarios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        Log::info(json_encode($request->all()));
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usersv = User::findOrFail($id);
        return view('usuarios.editarusuarios', compact('usersv') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $usersv = User::findOrFail($request->id);
        $usersv->Carnet_usuario = $request->Carnet_usuario ;
        $usersv->name=$request->name;
        $usersv->apellido_usuario=$request->apellido_usuario;
        $usersv->Nombre_usuario=$request->Nombre_usuario;
        $usersv->cargo_usuario =$request->cargo_usuario;
        $usersv->direccion_usuario =$request->direccion_usuario;
        $usersv->telefono_usuario=$request->telefono_usuario;
        $usersv-> email=$request->email;
        $usersv->password=Hash::make($request->password);
        $usersv->save();
        $usersv=User::all();
        return view('livewire.Users',['Users'=>$usersv ]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        $usersv=User::all();
        return view('livewire.Users',['Users'=>$usersv ]);
    }
}
