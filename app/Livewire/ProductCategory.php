<?php

namespace App\Livewire;

use App\Models\ProductCategory as ProductCategoryModel;

class ProductCategory extends Components
{
    public function __construct()
    {
        $this->modelName = 'category';
        $this->model = new ProductCategoryModel();
        parent::__construct();
    }


    public function createProductCategory()
    {
        return $this->create();
    }

    public function editProductCategory($id)
    {
        return $this->edit($id);
    }

    public function saveProductCategory()
    {
        return $this->save();
    }
}
