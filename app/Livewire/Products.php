<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination;
    /**
     * @var
     */
    protected $products;


    public function __construct()
    {
        $this->products = Product::getAll();
    }

    public function index()
    {
        return view('livewire.products',['products' => $this->products->paginate(10)]);
    }

    public function view()
    {
        $infos = [
            "image",
            "name",
            "price",
            "category_name",
            "description",
            "actions"];
        return view('livewire.admin.products.list',['products' => $this->products->paginate(10), 'title' => "Ver Produtos", 'infos' => $infos]);
    }

    public function editProduct($id){
        $product = Product::findOrFail($id);
        return view('livewire.admin.products.edit',['product' => $product, 'title' => "Editar Produto"]);
    }

    public function saveProduct($id){
        $product = new Product();

        $data = request()->validate($product->getRules(request()->id));
        $update = $product->updateOrCreate($data);

        if($update){
            return redirect()->route('products.view')->with('message', 'Operação realizada com sucesso.');;
        }

        return redirect()->back()->withInput()->with('error_message', "Operação não realizada");

    }


}
