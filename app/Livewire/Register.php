<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $users, $email, $password, $name;
    public $user_type_id = 2;

    public function render()
    {
        return view('livewire.register');
    }

    /**
     * @return array
     */
    public function handleRegister()
    {
        $data = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $this->password = Hash::make($this->password);


        User::create($this->all());

        session()->flash("Registrado fdp");
    }

}
