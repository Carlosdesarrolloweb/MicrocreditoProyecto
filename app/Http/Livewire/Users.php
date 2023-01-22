<?php

namespace App\Http\Livewire;

use App\Http\Controllers\UsersController;
use Livewire\Component;
use App\Models\User;

class Users extends Component
{   
    public $usersv,$id,$Carnet_usuario,$name,$apellido_usuario,$Nombre_usuario,
    $cargo_usuario,$direccion_usuario,$telefono_usuario,$email,$password;
  

    public function render()
    {
        $this->usersv=User::all();
        return view('livewere.Users',['Users'=>$this->usersv ]);
    }
/*     public function crear(){  

        $this->limpiar();
        $this->abrir();

    }
    public function abrir(){  

        $this->modal=true;        
    }
    public function cerrar(){  

        $this->modal=false;        
    } */
/*     public function limpiarcampos(){
        $this->Carnet_usuario ='';
        $this->name='';
        $this->apellido_usuario='';
        $this->Nombre_usuario='';
        $this->cargo_usuario ='';
        $this->direccion_usuario ='';
        $this->telefono_usuario='';
        $this-> email='';
        $this->password='';
         
    } */
    public function editar($id)
    { 
        $usersv = Users::finOrFail($id);
        $this-> id = $id;
        $this->Carnet_usuario = $usersv->Carnet_usuario;
        $this->name=$usersv->name;
        $this->apellido_usuario=$usersv->apellido_usuario;
        $this->Nombre_usuario=$usersv->Nombre_usuario;
        $this->cargo_usuario =$usersv->cargo_usuario;
        $this->direccion_usuario =$usersv->direccion_usuario;
        $this->telefono_usuario=$usersv->telefono_usuario;
        $this-> email=$usersv->email;
        $this->password=$usersv->password;
    }
    public function eliminar($id) { 
    
        Users::find($id)->delete;
    }


}
