<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Foto;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{

    public function index()
    {
        return view('livewire.clientes',['Clientes'=>Cliente::all()]);
    }
    public function store(Request $request)
    {
        Log::info(json_encode($request->all()));
        return 1;
    }

    public function create(Request $request)
    {
        $cliente = new Cliente();
        $foto = new Foto();
        $Foto = null;
        
        if($request->hasfile('id_foto','id_fotocarnet','id_fotorecibo','id_fotocroquis'));
        {
            $id_foto = $request->file('id_foto');
            $id_fotocarnet = $request->file('id_fotocarnet');
            $id_fotorecibo = $request->file('id_fotorecibo');
            $id_fotocroquis = $request->file('id_fotocroquis');
     
            if($id_foto != null) {
                $destinationPath = 'public\storage';
                $filename = time() . '-' . $id_foto->getClientOriginalName();
                if ($id_foto->move($destinationPath,$filename)){
                    $foto->direccion_imagen = $destinationPath . $filename;
                    $foto->url_imagen = env('APP_URL'). $destinationPath . $filename;
                    $foto->save();
                    //obtener las coincidencias que pille first
                    $Foto=Foto::where('url_imagen',config('url') . $destinationPath . $filename)->first();
                }
            }

        $cliente->Carnet_cliente = $request->Carnet_cliente;
        $cliente->nombre_cliente=$request->nombre_cliente;
        $cliente->apellido_cliente=$request->apellido_cliente;
        $cliente->direccion_cliente=$request->direccion_cliente;
        $cliente->email_cliente =$request->email_cliente;
        $cliente->telefono_cliente =$request->telefono_cliente;
        $cliente->edad_cliente=$request->edad_cliente;
        $cliente-> telefono_referencia=$request->telefono_referencia;
        $cliente->estado_cliente=$request->estado_cliente;
        //el if solo si la foto se guardo en la base de datos
        $fotos = ['id_foto','id_fotocarnet','id_fotorecibo','id_fotocroquis'];

        for ($i = 0; $i < count($fotos); $i++) {
            if ($request->hasFile($fotos[$i])) {
                $foto = new Foto();
                $foto->foto = $request->file($fotos[$i])->store('imgclientes');
                $cliente->{$fotos[$i]}()->save($foto);
            }
        }
        $cliente->save();
        
        return view('clientes.crearclientes');
        
         }
    }
    public function show(){
       
        return view('clientes.crearclientes');

    }

}
