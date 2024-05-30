<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\User as UserModel;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Components
{

    use WithPagination;

    protected string $viewFolder;

    /**
     * @var
     */

    public function __construct()
    {
        $this->modelName = 'user';
        $this->model = new UserModel();
        parent::__construct();
    }

    public function index()
    {
        return view('livewire.user', ['products' => $this->model->paginate(10)]);
    }

    public function createUser()
    {
        return $this->create();
    }

    public function saveUser()
    {
        return $this->save();
    }

    public function editUser($id)
    {
        return $this->edit($id);
    }

}
