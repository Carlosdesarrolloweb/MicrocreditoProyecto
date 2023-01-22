<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
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
    public function editar(Request $request)
    { 
        /* $usersv = Users::finOrFail($request->id);
        $this-> id = $id;
        $usersv->Carnet_usuario = request()->Carnet_usuario;
        $usersv->name=$usersv->name;
        $usersv->apellido_usuario=$usersv->apellido_usuario;
        $usersv->Nombre_usuario=$usersv->Nombre_usuario;
        $usersv->cargo_usuario =$usersv->cargo_usuario;
        $usersv->direccion_usuario =$usersv->direccion_usuario;
        $usersv->telefono_usuario=$usersv->telefono_usuario;
        $usersv-> email=$usersv->email;
        $usersv->password=$usersv->password;
        $usersv->save(); */
    }
    public function eliminar($id) { 
    
        User::find($id)->delete();
    }


}
