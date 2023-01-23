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
        
        if($request->hasfile('id_foto'));
        {
            $file = $request->file('id_foto');
            $destinationPath = 'storage/imgclientes/';
            $filename = time() . '-' . $file->getClientOriginalName();
           
            if ($request->file('id_foto')->move($destinationPath,$filename)){
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
        if(!is_null($Foto)){
            $cliente->id_foto=$Foto->id;
        }
        $cliente->save();
        
        return view('clientes.crearclientes');
        

    }
    public function show(){
       
        return view('clientes.crearclientes');

    }

}
