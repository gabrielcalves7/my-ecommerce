<?php

namespace App\Livewire;

use App\Models\User as userModel;
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
            "phone",
            "birthDate",
            "document",
            "actions",
        ];
        $this->user->paginate(10);
        return view('livewire.admin.users.list', [
            'data' => $this->user->paginate(10),
            'title' => "Ver Produtos",
            'infos' => $columns
        ]);
    }

    public function editUser($id)
    {
        $user = \App\Models\User::findOrFail($id);

        $fields = $user->createForm($user);

        return view('livewire.admin.users.edit',
            [
                'product' => $user,
                'title' => "Editar Usuário",
                "fields" => $fields,

            ]
        );
    }

    public function saveUser()
    {
        $user = new userModel();

        $data = request()->validate($user->getRules(request()->id));
        $update = $user->updateOrCreate($data);

        if ($update) {
            return redirect()->route('users.view')->with([
                'message' => "Operação realizada com sucesso",
                'type' => "success"
            ]);
        }
        return redirect()->back()->with([
            'message', "Operação não realizada",
            'type' => 'warning'
        ]);
    }
}
