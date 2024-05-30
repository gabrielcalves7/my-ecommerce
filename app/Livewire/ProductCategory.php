<?php

namespace App\Livewire;

use App\Models\ProductCategory as ProductCategoryModel;
use Livewire\Component;

class ProductCategory extends Component
{
    public function __construct()
    {
        $this->provider = new ComponentServiceProvider(new ProductCategoryModel(),"category");
    }

    public function view()
    {
        return $this->provider->view();
    }

    public function edit($id)
    {
        return $this->provider->edit($id);
    }

    public function create()
    {
        return $this->provider->create();
    }

    public function save()
    {
        return $this->provider->save();
    }
}
