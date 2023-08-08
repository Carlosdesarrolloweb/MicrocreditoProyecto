<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Foto;
use Illuminate\Support\Facades\Log;
use App\Helper\Images;
use Illuminate\Support\Facades\Hash;
use App\Models\Zona;
use App\Models\Garantia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Database\Eloquent\Collection\links;
use Illuminate\Pagination\LengthAwarePaginator;


class ClienteController extends Controller
{
    protected $images;
    public function __construct(){
        $this->images = new Images();
    }
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->get();
        return view('livewire.clientes', ['Clientes' => $clientes]);
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

        $carnetCliente = $request->input('Carnet_cliente');

        // Verificar si ya existe un cliente con el carnet proporcionado
        $clienteExistente = Cliente::where('Carnet_cliente', $carnetCliente)->first();

        if ($clienteExistente) {
            return redirect()->back()->withErrors(['Carnet_cliente' => 'Ya existe un cliente con este carnet.']);
        }



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

        // Obtener el nombre y carnet de identidad del cliente
        $nombreCliente = $request->nombre_cliente;
        $carnetCliente = $request->Carnet_cliente;
        $apellidoCliente=$request->apellido_cliente;
        $direccionCliente=$request->direccion_cliente;
        $telefonoCliente=$request->telefono_cliente;
        $zonaCliente=$request->zona_id;

        // Registro en la bitácora
        $usuarioId = Auth::id();
        $accion = 'Creación de cliente - "' . $nombreCliente . ' Apellido: ' . $apellidoCliente .' Dirección: '. $direccionCliente .' Telefono: '. $telefonoCliente .' Zona: '.$zonaCliente .' CI: '. $carnetCliente . '"';
        $tablaAfectada = 'clientes';
        DB::table('bitacora')->insert([
            'usuario_id' => $usuarioId,
            'accion' => $accion,
            'tabla_afectada' => $tablaAfectada,
            'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
        ]);
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

        // Guardar los valores actuales antes de la actualización
        $nombreClienteAnterior = $clientesv->nombre_cliente;
        $apellidoClienteAnterior = $clientesv->apellido_cliente;
        $direccionClienteAnterior = $clientesv->direccion_cliente;
        $emailanterior = $clientesv->email_cliente;
        $telefonoanterior=  $clientesv->telefono_cliente;
        $edadanterior = $clientesv->edad_cliente;
        $telefonoanteriorref= $clientesv->telefono_referencia;
        $estadoanterior= $clientesv->estado_cliente;
        $zonaanterior= $clientesv->zona_id;
        // ... Agregar los demás campos según sea necesario

        // Actualizar los datos del cliente
        $clientesv->Carnet_cliente = $request->Carnet_cliente;
        $clientesv->nombre_cliente = mb_strtoupper($request->nombre_cliente);
        $clientesv->apellido_cliente = mb_strtoupper($request->apellido_cliente);
        $clientesv->direccion_cliente = mb_strtoupper($request->direccion_cliente);
        $clientesv->email_cliente =mb_strtoupper($request->email_cliente);
        $clientesv->telefono_cliente =$request->telefono_cliente;
        $clientesv->edad_cliente=$request->edad_cliente;
        $clientesv-> telefono_referencia=$request->telefono_referencia;
        $clientesv-> estado_cliente=mb_strtoupper($request->estado_cliente);
        $clientesv->zona_id = $request->zona_id;
        $clientesv->save();

        // Comparar los valores antes y después de la actualización
        $cambios = [];

        if ($clientesv->nombre_cliente !== $nombreClienteAnterior) {
            $cambios[] = 'Nombre: ' . $nombreClienteAnterior . ' -> ' . $clientesv->nombre_cliente;
        }
        if ($clientesv->apellido_cliente !== $apellidoClienteAnterior) {
            $cambios[] = 'Apellido: ' . $apellidoClienteAnterior . ' -> ' . $clientesv->apellido_cliente;
        }
        if ($clientesv->direccion_cliente !== $direccionClienteAnterior) {
            $cambios[] = 'Direccion: ' . $direccionClienteAnterior . ' -> ' . $clientesv->direccion_cliente;
        }
        if ($clientesv->email_cliente !== $emailanterior) {
            $cambios[] = 'Email: ' . $emailanterior . ' -> ' . $clientesv->email_cliente;
        }
        if ($clientesv->telefono_cliente !== $telefonoanterior) {
            $cambios[] = 'Telefono: ' . $telefonoanterior . ' -> ' . $clientesv->telefono_cliente;
        }
        if ($clientesv->edad_cliente !== $edadanterior) {
            $cambios[] = 'Edad: ' . $edadanterior . ' -> ' . $clientesv->edad_cliente;
        }
        if ($clientesv->telefono_referencia !== $telefonoanteriorref) {
            $cambios[] = 'Referencia: ' . $telefonoanteriorref . ' -> ' . $clientesv->telefono_referencia;
        }
        if ($clientesv->estado_cliente !== $estadoanterior) {
            $cambios[] = 'Estado: ' . $estadoanterior . ' -> ' . $clientesv->estado_cliente;
        }
        if ($clientesv->zona_id !== $zonaanterior) {
            $cambios[] = 'Zona: ' . $zonaanterior . ' -> ' . $clientesv->zona_id;
        }


        // Registro en la bitácora
        $usuarioId = Auth::id();
        $accion = 'Actualización de cliente - "'. implode(', ', $cambios) . '"';
        $tablaAfectada = 'clientes';
        DB::table('bitacora')->insert([
            'usuario_id' => $usuarioId,
            'accion' => $accion,
            'tabla_afectada' => $tablaAfectada,
            'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        return redirect()->route('clientesv');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

            // Verificar si el cliente tiene préstamos asociados
        if ($cliente->prestamos()->exists())
        {
        return redirect()->route('clientesv')->with('error', 'No se puede borrar el cliente porque tiene un préstamo asignado.');
        }

            // Guardar los valores del cliente antes de eliminarlo
        $valoresCliente = [
            'Carnet_cliente' => $cliente->Carnet_cliente,
            'nombre_cliente' => $cliente->nombre_cliente,
            'apellido_cliente' => $cliente->apellido_cliente,
            // ... Agregar los demás campos según sea necesario
        ];

            // Si no hay préstamos asociados, proceder a eliminar el cliente
        $cliente->delete();

            // Registro en la bitácora
        $usuarioId = Auth::id();
        $accion = 'Eliminación de cliente - "'. implode(', ', $valoresCliente) . '"';
        $tablaAfectada = 'clientes';
        DB::table('bitacora')->insert([
            'usuario_id' => $usuarioId,
            'accion' => $accion,
            'tabla_afectada' => $tablaAfectada,
            'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
        ]);

            // Redireccionar a la vista de clientes
        $clientesv = Cliente::all();
        return redirect()->route('clientesv');
    }

    public function mostrarCliente($criterio)
    {
        $clientes = Cliente::where('Carnet_cliente', 'like', '%' . $criterio . '%')
                            ->orWhere('nombre_cliente', 'like', '%' . $criterio . '%')
                            ->orWhere('telefono_cliente', 'like', '%' . $criterio . '%')
                            ->get();

        return view('clientes.mostrar', compact('clientes'));
    }

    public function dashboard()
    {
        $clientes = Cliente::all();
        $cantidad_clientes = Cliente::count();
        $clientes_con_prestamo = Cliente::has('prestamos')->get();
        $cantidad_clientes_con_prestamo = count($clientes_con_prestamo);
        $cantidad_garantias = Garantia::count();

        return view('dashboard', compact('clientes', 'cantidad_clientes', 'cantidad_clientes_con_prestamo', 'cantidad_garantias'));
    }

    public function buscarClientes(Request $request)
    {
        $query = $request->input('search_term');

        $clientes = Cliente::where('nombre_cliente', 'LIKE', '%' . $query . '%')
                           ->orWhere('Carnet_cliente', 'LIKE', '%' . $query . '%')
                           ->paginate(10);

        return view('clientes.clientesv', compact('clientes'));
    }

    public function obtenerDatosCliente(Request $request)
    {
        $validatedData = $request->validate([
            'Carnet_cliente' => 'required'
        ]);

        $carnetCliente = $request->Carnet_cliente;

        $cliente = Cliente::where('Carnet_cliente', $carnetCliente)->first();

        if ($cliente) {
            return response()->json([
                'success' => true,
                'cliente' => $cliente
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cliente no encontrado'
            ]);
        }
    }
    public function obtenerEstadosClientes()
    {
        $estadosClientes = Cliente::select(DB::raw('estado_cliente as estado, count(*) as cantidad'))
            ->groupBy('estado_cliente')
            ->get();

        return response()->json($estadosClientes);
    }
}
