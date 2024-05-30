<?php

namespace App\Livewire;

use App\Models\Product as ProductModel;

class Product extends Components
{
    public function __construct()
    {
        $this->modelName = 'product';
        $this->model = new ProductModel();
        parent::__construct();
    }

}
