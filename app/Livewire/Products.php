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
        return view('livewire.products',['products' => $this->products->paginate(12)]);
    }

    public function view()
    {
        $columns = [
            "image",
            "name",
            "price",
            "category_name",
            "description",
            "actions"
        ];
        return view('livewire.admin.products.list',[
            'products' => $this->products->paginate(10),
            'title' => "Ver Produtos",
            'infos' => $columns
        ]);
    }

    public function editProduct($id){
        $product = Product::findOrFail($id);
        $fields = $product->createForm($product);

        return view('livewire.admin.users.edit',[
            'product' => $product,
            'model' => 'products',
            'title' => "Editar Produto",
            'fields' => $fields,
        ]);
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
