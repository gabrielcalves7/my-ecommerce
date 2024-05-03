<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginRegister extends Component
{
    public $users, $email, $password;

    public $register = false;

    public function render()
    {
        return view('livewire.login', [
            'register' => $this->register
        ]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    /**
     * @return array
     */
    public function login()
    {
        $validData = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            session()->flash("Message", "logado");
            return redirect()->intended('/admin');
        } else {
            session()->flash("Message", "deslogado");
            return redirect()->back();
        }
    }

    public function registerForm()
    {
        $this->register = !$this->register;
    }

    public function registerStore()
    {
        $data = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $this->password = Hash::make($this->password);

        User::create(['email' => $this->email, 'password' => $this->password]);

        session()->flash("Registrado fdp");
        $this->resetInputFields();
    }

}
