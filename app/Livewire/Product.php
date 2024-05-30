<?php

namespace App\Livewire;

use App\Models\Product as ProductModel;

class Product extends Components
{
private ComponentServiceProvider $provider;
    public function __construct()
    {
        $this->provider = new ComponentServiceProvider(new ProductModel(),"product");
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
