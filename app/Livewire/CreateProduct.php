<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component
{

    public $name = '';

    public $content = '';

    public function save()
    {
        Product::create(
            $this->only(['title', 'content'])
        );

        return $this->redirect()->back()
            ->with('status', 'Post successfully created.');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
