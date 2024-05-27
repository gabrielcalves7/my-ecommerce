<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\User as UserModel;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{

    use WithPagination;

    private const VIEW_FOLDER = 'livewire.admin.users.';
    /**
     * @var
     */
    private string $model;

    protected $user;

    public function __construct()
    {
        $this->model = 'user';
        $this->user = new UserModel();
    }

    public function index()
    {
        return view('livewire.user', ['products' => $this->user->paginate(10)]);
    }

    public function view()
    {
        $data = $this->user->getAll();

        $fields = $this->user->getFieldsForFormattedList();

        $searchParams = request()->get(ucfirst($this->model) . "Search");

        if ($searchParams != []) {
            $data = $this->product->handlePaginatedListsFilters($data, $searchParams);
        }

        $orderAsc = $searchParams['asc'] ?? 0;

        return view(self::VIEW_FOLDER . 'list', [
            'data' => $data->paginate(10),
            'isOrderAsc' => $orderAsc,
            'model' => $this->model,
            'title' => "Ver Produtos",
            'unfilterableFields' => $this->user->unfilterableFields(),
            'infos' => Helper::flattenArray($fields),
        ]);
    }


    public function editUser($id)
    {
        $user = $this->user->findOrFail($id);

        $fields = $user->createForm($user);

        return view(
            self::VIEW_FOLDER . 'edit',
            [
                'modelData' => $user,
                'title' => "Editar Usuário",
                'fields' => $fields,
                'model' => $this->model,
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
