<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;


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

        $validatedData = $request->validate([
            'password' => 'required|min:8',
        ]);
        $validatedData = $request->validate([
            'Carnet_usuario' => 'required|min:5',
        ]);
        $validatedData = $request->validate([
            'name' => 'required|min:5',
        ]);
        $validatedData = $request->validate([
            'Nombre_usuario' => 'required|min:5',
        ]);
        $validatedData = $request->validate([
            'direccion_usuario' => 'required|min:10',
        ]);
        $validatedData = $request->validate([
            'telefono_usuario' => 'required|min:8',
        ]);

        $usuario->Carnet_usuario = $request->Carnet_usuario;
        $usuario->name= mb_strtoupper($request->name);
        $usuario->apellido_usuario= mb_strtoupper($request->apellido_usuario);
        $usuario->Nombre_usuario=mb_strtoupper($request->Nombre_usuario);
        $usuario->cargo_usuario =mb_strtoupper($request->cargo_usuario);
        $usuario->direccion_usuario =mb_strtoupper($request->direccion_usuario);
        $usuario->telefono_usuario=$request->telefono_usuario;
        $usuario-> email=mb_strtoupper($request->email);
        $usuario->password = Hash::make($request->password);
        $usuario->estado_usuario  =mb_strtoupper($request->estado_usuario);
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
        $usersv->name=mb_strtoupper($request->name);
        $usersv->apellido_usuario=mb_strtoupper($request->apellido_usuario);
        $usersv->Nombre_usuario=mb_strtoupper($request->Nombre_usuario);
        $usersv->cargo_usuario =mb_strtoupper($request->cargo_usuario);
        $usersv->direccion_usuario =mb_strtoupper($request->direccion_usuario);
        $usersv->telefono_usuario=$request->telefono_usuario;
        $usersv-> email=mb_strtoupper($request->email);
        $usersv->password=Hash::make($request->password);
        $usersv->estado_usuario  =mb_strtoupper($request->estado_usuario);
        $usersv->save();
        $usersv=User::all();
        // return view('livewire.Users',['Users'=>$usersv ]);

        return redirect()->route('livewire.Users')->with('success', 'Registros actualizados correctamente.');
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
        return view('livewire.Users',['Users'=>$usersv ])->with('eliminaru','ok');
    }

/*     public function login(Request $request)
    {
        $credentials = $request->only('Nombre_usuario', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->estado_usuario === 'inactivo') {
                Auth::logout();
                return redirect('/')->with('status', 'Tu cuenta ha sido desactivada.');
            }
            return redirect()->intended('/dashboard');
        } else {
            return redirect()->back()->withErrors([
                'email' => 'Las credenciales proporcionadas son inválidas.',
            ]);
        }
    }


public function updateEstado($id, $estado)
{
    $user = User::findOrFail($id);

    // Verificar que el estado sea válido
    if (!in_array($estado, ['activo', 'inactivo'])) {
        abort(400, 'Estado inválido');
    }

    // Actualizar el estado del usuario
    $user->estado_usuario = $estado;
    $user->save();

    return redirect()->back()->with('message', 'El estado del usuario se actualizó correctamente.');
} */

public function banearUsuario($id)
{
    $usuario = User::findOrFail($id);
    $usuario->estado_usuario = 'inactivo';
    $usuario->save();

    return redirect()->route('user.index')->with('banear', 'El usuario ha sido baneado exitosamente');
}

}
