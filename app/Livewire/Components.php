<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Models;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Components extends Component
{
    use WithPagination;

    protected string $modelName;
    protected string $viewFolder;
    protected Models $model;

    public function __construct()
    {
        $this->viewFolder = 'livewire.admin.' . $this->modelName . '.';
    }

    public function index()
    {
    }

    public function view()
    {
        $data = $this->model->getAll();

        $fields = $this->model->getFieldsForFormattedList();

        $searchParams = request()->get(ucfirst($this->modelName) . "Search");

        if ($searchParams != []) {
            $data = $this->model->handlePaginatedListsFilters($data, $searchParams);
        }

        $orderAsc = $searchParams['asc'] ?? 0;

        return view($this->viewFolder . 'list', [
            'data' => $data->paginate(10),
            'isOrderAsc' => $orderAsc,
            'model' => $this->modelName,
            'title' => 'List ' . ucfirst($this->modelName) . 's',
            'unfilterableFields' => $this->model->unfilterableFields(),
            'infos' => Helper::flattenArray($fields),
        ]);
    }

    public function edit($id)
    {
        $model = $this->model->findOrFail($id);

        $fields = $model->createForm();

        return view(
            $this->viewFolder . 'edit',
            [
                'modelData' => $model,
                'title' => "Edit {$this->modelName}",
                'hasImage' => isset($model->getRules()['image']),
                'fields' => $fields,
                'model' => $this->modelName,
            ]
        );
    }

    public function create()
    {
        $model = $this->model;

        $fields = $model->createForm();

        return view(
            $this->viewFolder . 'edit',
            [
                'modelData' => $model,
                'title' => "Create {$this->modelName}",
                'fields' => $fields,
                'hasImage' => isset($model->getRules()['image']),
                'model' => $this->modelName,
            ]
        );
    }

    public function save()
    {
        $data = request()->validate($this->model->getRules(request()->id));

        $update = $this->model->updateOrCreate($data);

        if ($update) {
            return redirect()->route($this->modelName . '.view')->with([
                'message' => "Operação realizada com sucesso",
                'type' => "success"
            ]);
        }
        return redirect()->back()->with([
            'message',
            'Operação não realizada',
            'type' => 'warning'
        ]);
    }
}