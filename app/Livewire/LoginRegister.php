<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
            return redirect()->route('admin')->with([
                'message' => 'Você está logado.',
                'type' => 'success'
            ]);
        } else {
            session()->flash('message', 'Your  message here');
            return redirect()->route('login')->with(
                ['message' => 'Não foi possivel realizar o login, por favor tente novamente.', 'type' => 'warning']
            );
        }
//        return redirect()->route('users.view')->with([
//            'message' => "Operação realizada com sucesso",
//            'type' => "success"
//        ]);
//    }
//return redirect()->back()->with([
//'message', "Operação não realizada",
//'type' => 'warning'
//]);
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

    public function logout(){
        Auth::logout();
    }

}
