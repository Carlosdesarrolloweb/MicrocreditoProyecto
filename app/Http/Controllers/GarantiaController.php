<?php

namespace App\Http\Controllers;

use App\Models\Garantia;
use App\Models\Cliente;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Helper\Images;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GarantiaController extends Controller
{
    protected $images;

    public function __construct()
    {
        $this->images = new Images();
    }

    public function create(Request $request)
    {
        $prestamos = Prestamo::all();
        $clientes = Cliente::all();
        return view('garantias.create', compact('prestamos', 'clientes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'garantia' => 'required',
            'Detalle_Prenda' => 'required',
            'estado' => 'required',
            'cliente_id' => 'required',
            'id_prestamo' => 'required',
        ]);

        $garantia = new Garantia();

        $garantia->garantia = mb_strtoupper($request->garantia);
        $garantia->Detalle_Prenda = mb_strtoupper($request->Detalle_Prenda);
        $garantia->estado = mb_strtoupper($request->estado);

        if ($request->has('Valor_Prenda')) {
            $garantia->Valor_Prenda = $request->Valor_Prenda;
        }

        if ($request->has('fecha_entrega')) {
            $garantia->fecha_entrega = $request->fecha_entrega;
        }

        $helper = new Images(); // Crear una instancia del helper

        if ($request->hasFile('id_foto')) {
            $clienteId = $request->cliente_id;
            $fotoid = $helper->uploadFile($clienteId, $request->file('id_foto'));

            $garantia->id_foto = $fotoid;

        }

        $garantia->id_cliente = $request->cliente_id;
        $garantia->id_prestamo = $request->id_prestamo;
        $garantia->save();

            // Bitacora
        $garantia->id_cliente = $request->cliente_id;
        $garantia->id_prestamo = $request->id_prestamo;
        $garantia->garantia = $request->garantia;
        $garantia->save();

            // Registro en la bitácora
        $usuarioId = Auth::id();
        $accion = 'Creación de garantía - ID: ' . $garantia->id .  ', Garantia: ' . $garantia->garantia . ', Cliente: ' . $garantia->cliente->nombre_cliente . ' ' . $garantia->cliente->apellido_cliente;
        $tablaAfectada = 'garantias';
        DB::table('bitacora')->insert([
            'usuario_id' => $usuarioId,
            'accion' => $accion,
            'tabla_afectada' => $tablaAfectada,
            'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        return redirect()->route('garantias.index');
    }
    public function index()
    {
        $garantias = Garantia::all();

        return view('garantias.index', compact('garantias'));
    }
    public function getPrestamosByCliente($clienteId)
    {
        $prestamos = Prestamo::where('id_cliente', $clienteId)->get();

        return response()->json(['prestamos' => $prestamos]);
    }


    public function destroy($id)
    {
        $garantia = Garantia::findOrFail($id);

        // Registro en la bitácora
        $usuarioId = Auth::id();
        $accion = 'Eliminación de garantía - ID: ' . $garantia->id . ', Valor: ' . $garantia->valor_prenda . ', Detalle: ' . $garantia->Detalle_Prenda . ', Cliente: ' . $garantia->cliente->nombre_cliente . ' ' . $garantia->cliente->apellido_cliente;
        $tablaAfectada = 'garantias';
        DB::table('bitacora')->insert([
            'usuario_id' => $usuarioId,
            'accion' => $accion,
            'tabla_afectada' => $tablaAfectada,
            'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        $garantia->delete();

        return response()->json(['success' => true]);
    }
    public function edit(Garantia $garantia)
    {
        $clientes = Cliente::all();
        return view('garantias.edit', compact('garantia', 'clientes'));

    }

    public function update(Request $request, $id)
    {
        $garantia = Garantia::findOrFail($id);
        $valorPrendaAnterior = $garantia->valor_prenda;
        $detallePrendaAnterior = $garantia->Detalle_Prenda;

        $garantia->garantia = $request->garantia;
        $garantia->valor_prenda = $request->Valor_prenda;
        $garantia->Detalle_Prenda = $request->Detalle_Prenda;
        $garantia->fecha_entrega = $request->fecha_entrega;
        $garantia->estado = $request->estado;
        $garantia->save();

        // Registro en la bitácora
        $usuarioId = Auth::id();
        $accion = 'Actualización de garantía - ID: ' . $garantia->id . ', Valor anterior: ' . $valorPrendaAnterior . ', Nuevo valor: ' . $garantia->valor_prenda . ', Detalle anterior: ' . $detallePrendaAnterior . ', Nuevo detalle: ' . $garantia->Detalle_Prenda . ', Cliente: ' . $garantia->cliente->nombre_cliente . ' ' . $garantia->cliente->apellido_cliente;
        $tablaAfectada = 'garantias';
        DB::table('bitacora')->insert([
            'usuario_id' => $usuarioId,
            'accion' => $accion,
            'tabla_afectada' => $tablaAfectada,
            'fecha_registro' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        return redirect()->route('garantias.index')->with('success', 'Garantía actualizada exitosamente');
    }


}
