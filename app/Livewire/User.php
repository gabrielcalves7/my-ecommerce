<?php

namespace App\Livewire;

use App\Models\User as UserModel;

class User extends Components
{
    public function __construct()
    {
        $this->modelName = 'user';
        $this->model = new UserModel();
        parent::__construct();
    }
}
