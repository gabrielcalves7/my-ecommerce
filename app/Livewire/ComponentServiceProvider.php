<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Helpers\Helper;
use App\Models\Models;
use Livewire\Component;
use Livewire\WithPagination;

class ComponentServiceProvider
{
    use WithPagination;

    protected string $modelName;
    protected string $viewFolder;
    protected Model | Authenticatable $model;

    public function __construct($model, $modelName)
    {
        $this->model = $model;
        $this->modelName = $modelName;
        $this->viewFolder = 'livewire.admin.' . $this->modelName . '.';
    }

    public function view()
    {
        $data = $this->model->getAll();

        $fields = $this->model->getFieldsForFormattedList();

        $searchParams = request()->get(ucfirst($this->modelName) . "Search");

        if ($searchParams != []) {
            $data = $this->model->uploadableModel()->handlePaginatedListsFilters($data, $searchParams,$this->model);
        }

        $orderAsc = $searchParams['asc'] ?? 0;

        return view($this->viewFolder . 'list', [
            'data' => $data->paginate(10),
            'isOrderAsc' => $orderAsc,
            'model' => $this->modelName,
            'title' => 'List ' . ucfirst($this->modelName) . 's',
            'unfilterableFields' => $this->model->uploadableModel()->unfilterableFields(),
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

        $update = $this->model->uploadableModel()->updateOrCreate($this->model,$data);

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