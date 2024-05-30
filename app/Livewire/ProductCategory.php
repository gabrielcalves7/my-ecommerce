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
}
