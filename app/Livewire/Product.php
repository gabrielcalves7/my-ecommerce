<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Product as ProductModel;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Components
{

    public function __construct()
    {
        $this->modelName = 'product';
        $this->model = new ProductModel();
        parent::__construct();
    }

    public function saveProduct()
    {
        return $this->save();
    }

    public function editProduct($id)
    {
        return $this->edit($id);
    }

    public function createProduct()
    {
        return $this->create();
    }
}
