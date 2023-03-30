<?php

namespace App\Http\Controllers;

use App\Models\Garantia;
use App\Models\Cliente;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Helper\Images;

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

        if ($request->hasFile('id_foto')) {
            $path = public_path('public/garantias/' . $request->cliente_id);
            if (!file_exists($path)) {
                 mkdir($path, 0777, true);
            }
            $image = $request->file('id_foto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $rutaImagen = 'public/garantias/' . $request->cliente_id . '/' . $filename;
            $this->images->setImage($rutaImagen);
            $fotoid=$this->images->getImage($rutaImagen);

            $garantia->id_foto = $fotoid;
        }

        $garantia->id_cliente = $request->cliente_id;
        $garantia->id_prestamo = $request->id_prestamo;
        $garantia->save();
        
        return redirect()->route('garantias.index');
    }

    public  function index (){
        return view ('garantias.index');

    }
     public function getPrestamosByCliente($clienteId)
    {
        $prestamos = Prestamo::where('id_cliente', $clienteId)->get();

        return response()->json(['prestamos' => $prestamos]);
    }

}
