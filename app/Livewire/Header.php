<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{

    private $categories;
    private $user;
    private $userID;
    private $userType;

    public function __construct()
    {
        $userID = Auth::id();
        $this->userID = $userID;
        if ($userID != null) {
            $this->user = User::where('id', $userID);
            $this->userType = User::where('id', $userID)->select('user_type_id')->get();
        }
        $this->categories = $this->addNavigationToMenu();
    }

    private function menu()
    {
        return [
            ["name" => "Menu", "url" => null],
            ["name" => "Home", "url" => route('home')],
            ["name" => "Produtos", "url" => route('getProducts')],
            ["name" => "Serviços", "url" => null],
            ["name" => "Contato", "url" => null],
            ["name" => "Login", "url" => route('login')],
            ["name" => "Registrar", "url" => null]
        ];
    }

    private function addNavigationToMenu()
    {
        $categories = $this->menu();
        $actions = ["list", "create"];
        foreach ($actions as $action) {
            foreach ($categories as &$value) {
                $value['actions'][] = ["name" => $action, 'url' => '/' . $action];
            }
        }
        return $categories;
    }

    public function render()
    {
        return view('livewire.header', ['categories' => $this->categories, 'public' => true]);
    }
}
