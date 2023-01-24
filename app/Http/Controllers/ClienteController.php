<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Foto;
use Illuminate\Support\Facades\Log;
use App\Helper\Images;

class ClienteController extends Controller
{
    protected $images;
    public function __construct(){
        $this->images = new Images();
    }
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
        $id_foto = null;
        $id_fotocarnet = null;
        $id_fotorecibo = null;
        $id_fotocroquis = null;
        if(
            $request->hasfile('id_foto') && 
            $request->hasfile('id_fotocarnet') && 
            $request->hasfile('id_fotorecibo') && 
            $request->hasfile('id_fotocroquis')
        )
        {
            $id_foto = $this->images->uploadFile(
                $request->Carnet_cliente,
                $request->file('id_foto')
            );
            $id_fotocarnet = $this->images->uploadFile(
                $request->Carnet_cliente,
                $request->file('id_fotocarnet')
            );
            $id_fotorecibo = $this->images->uploadFile(
                $request->Carnet_cliente,
                $request->file('id_fotorecibo')
            );
            $id_fotocroquis = $this->images->uploadFile(
                $request->Carnet_cliente,
                $request->file('id_fotocroquis')
            );
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
        $cliente->id_foto = $id_foto;
        $cliente->id_fotocarnet = $id_fotocarnet;
        $cliente->id_fotorecibo = $id_fotorecibo;
        $cliente->id_fotocroquis = $id_fotocroquis;
        $cliente->save();
        
        return view('clientes.crearclientes');
    }
    public function show(){
       
        return view('clientes.crearclientes');

    }

}
