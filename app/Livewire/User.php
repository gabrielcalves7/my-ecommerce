<?php

namespace App\Livewire;

use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{

    use WithPagination;

    /**
     * @var
     */
    protected $user;

    public function __construct()
    {
        $this->user = \App\Models\User::getAll();;
    }

    public function index()
    {
        return view('livewire.user', ['products' => $this->user->paginate(10)]);
    }

    public function view()
    {
        $columns = [
            "name",
            "email",
            "userType",
            "phoneNumber",
            "birthDate",
            "document",
            "actions",
        ];
        $a = $this->user->paginate(10);

        return view('livewire.admin.users.list', [
            'data' => $a,
            'langFile' => "users",
            'title' => "Ver Produtos",
            'infos' => $columns
        ]);
    }

    public function editUser($id)
    {
        $user = \App\Models\User::findOrFail($id);

        $fields = $user->createForm($user);

        return view(
            'livewire.admin.users.edit',
            [
                'product' => $user,
                'title' => "Editar Usuário",
                "fields" => $fields,
                'model' => "users"
            ]
        );
    }

    public function saveUser()
    {
        $user = new UserModel();

        $data = request()->validate($user->getRules(request()->id));
        $update = $user->updateOrCreate($data);

        if ($update) {
            return redirect()->route('users.view')->with([
                'message' => "Operação realizada com sucesso",
                'type' => "success"
            ]);
        }
        return redirect()->back()->with([
            'message',
            "Operação não realizada",
            'type' => 'warning'
        ]);
    }
}
