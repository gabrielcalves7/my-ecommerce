<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class App extends Component
{
    public function index(){
        $products = Product::getAll()->paginate(15);
        return view('livewire.home', ['products' => $products, 'public' => true]);
    }
}
