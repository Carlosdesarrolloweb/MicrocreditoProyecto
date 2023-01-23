<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;
use Livewire\Component;
use App\Models\Cliente;

class Clientes extends Component
{   
    public $clientesv,
             $Carnet_cliente,
             $nombre_cliente,
             $apellido_cliente,
              $direccion_cliente,
             $email_cliente,
             $telefono_cliente,
             $edad_cliente,
             $telefono_referencia,
             $estado_cliente;
  

    public function render()
    {
        $this->clientesv=Cliente::all();
        return view('livewire.Clientes',['Clientes'=>$this->clientesv ]);
    }
}