<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Foto;
use Illuminate\Support\Facades\Log;
use App\Helper\Images;
use Illuminate\Support\Facades\Hash;

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
        
        $validatedData = $request->validate([
            'Carnet_cliente' => 'required|min:5',
        ]);
        $validatedData = $request->validate([
            'nombre_cliente' => 'required|min:5',
        ]);
        $validatedData = $request->validate([
            'apellido_cliente' => 'required|min:5',
        ]);
        $validatedData = $request->validate([
            'direccion_cliente' => 'required|min:10',
        ]);
        $validatedData = $request->validate([
            'email_cliente' => 'required|min:5',
        ]);
        $validatedData = $request->validate([
            'telefono_cliente' => 'required|min:8',
        ]);
        $validatedData = $request->validate([
            'edad_cliente' => 'required|min:2',
        ]);
        $validatedData = $request->validate([
            'telefono_referencia' => 'required|min:8',
        ]);


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
    public function edit($id)
    {
        $clientesv = Cliente::findOrFail($id);
        return view('clientes.editarclientes', compact('clientesv') );
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
        $clientesv = Cliente::findOrFail($request->id);
        $clientesv->Carnet_cliente = $request->Carnet_cliente ;
        $clientesv->nombre_cliente=$request->nombre_cliente;
        $clientesv->apellido_cliente=$request->apellido_cliente;
        $clientesv->direccion_cliente=$request->direccion_cliente;
        $clientesv->email_cliente =$request->email_cliente;
        $clientesv->telefono_cliente =$request->telefono_cliente;
        $clientesv->edad_cliente=$request->edad_cliente;
        $clientesv-> telefono_referencia=$request->telefono_referencia;
        $clientesv-> estado_cliente=$request->estado_cliente;
        $clientesv-> id_foto=$request->id_foto;
        $clientesv-> id_fotocarnet=$request->id_fotocarnet;
        $clientesv-> id_fotorecibo=$request->id_fotorecibo;
        $clientesv-> id_fotocroquis=$request->id_fotocroquis;
        $clientesv->save();
        $clientesv=Cliente::all();
        return view('livewire.Clientes',['Clientes'=>$clientesv ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::find($id)->delete();
        $clientesv=Cliente::all();
        return view('livewire.Clientes',['Clientes'=>$clientesv ]);
    }
    




}
