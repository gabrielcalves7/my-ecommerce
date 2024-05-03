<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Admin extends Component
{
    protected $p_User;

    protected $public = false;

    public function __construct()
    {
        $this->p_User = Auth::id();
    }

    public function index()
    {
        return view('livewire.admin.index', ['user' => $this->p_User]);
    }


}
