<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{   
    public $usersv;

    public function render()
    {
        $this->usersv=User::all();
        return view('User',['Users'=>$this->usersv ]);
    }
}
