<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Foto;
use Illuminate\Support\Facades\Log;
use App\Helper\Images;
use Illuminate\Support\Facades\Hash;
use App\Models\Zona;


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
        $validatedData = $request->validate([
            'zona_id' => 'required',
        ]);

        $validatedData = $request->validate([
            'Carnet_cliente' => 'required|min:5',
        ]);
        $validatedData = $request->validate([
            'nombre_cliente' => 'required|min:3',
        ]);
        $validatedData = $request->validate([
            'apellido_cliente' => 'required|min:3',
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


        $cliente = new Cliente();
        $zonas = Zona::all();
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
        $cliente->nombre_cliente= mb_strtoupper($request->nombre_cliente);
        $cliente->apellido_cliente=mb_strtoupper($request->apellido_cliente);
        $cliente->direccion_cliente=mb_strtoupper($request->direccion_cliente);
        $cliente->email_cliente =mb_strtoupper($request->email_cliente);
        $cliente->telefono_cliente =$request->telefono_cliente;
        $cliente->edad_cliente=$request->edad_cliente;
        $cliente-> telefono_referencia=$request->telefono_referencia;
        $cliente->estado_cliente=mb_strtoupper($request->estado_cliente);
        $cliente->id_foto = $id_foto;
        $cliente->id_fotocarnet = $id_fotocarnet;
        $cliente->id_fotorecibo = $id_fotorecibo;
        $cliente->id_fotocroquis = $id_fotocroquis;
        $cliente->zona_id = $request->zona_id;
        $cliente->save();



        return view('clientes.crearclientes', compact('zonas'));

    }
    public function show(){

        $zonas = Zona::all();
        return view('clientes.crearclientes',compact('zonas'));

    }



    public function edit($id)
    {
      /*   $clientesv = Cliente::findOrFail($id);
        return view('clientes.editarclientes', compact('clientesv') ); */

        $clientesv = Cliente::findOrFail($id);
        $zonas = Zona::all();
        return view('clientes.editarclientes', compact('clientesv', 'zonas'));
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
        $clientesv->nombre_cliente=mb_strtoupper($request->nombre_cliente);
        $clientesv->apellido_cliente=mb_strtoupper($request->apellido_cliente);
        $clientesv->direccion_cliente=mb_strtoupper($request->direccion_cliente);
        $clientesv->email_cliente =mb_strtoupper($request->email_cliente);
        $clientesv->telefono_cliente =$request->telefono_cliente;
        $clientesv->edad_cliente=$request->edad_cliente;
        $clientesv-> telefono_referencia=$request->telefono_referencia;
        $clientesv-> estado_cliente=mb_strtoupper($request->estado_cliente);
        $clientesv->zona_id = $request->zona_id;
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
        return view('livewire.Clientes',['Clientes'=>$clientesv ])->with('eliminaru','ok');



        return response()->json(['success' => true]);



   /*      $clientesv = Cliente::find($id);

        if (!$clientesv) {
            return response()->json(['success' => false]);
        }

        $clientesv->delete();

        return response()->json(['success' => true]);
        return view('livewire.Clientes',['Clientes'=>$clientesv ])->with('eliminaru','ok'); */
    }


}
