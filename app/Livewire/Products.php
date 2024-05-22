<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination;

    /**
     * @var
     */

    private string $model;
    protected Product $product;
    private array $formatedListColumns;

    public function __construct()
    {
        $this->model = 'products';
        $this->product = new Product();
    }

    public function index()
    {
        return view('livewire.products', ['products' => $this->products->paginate(12)]);
    }

    public function view()
    {
        $data = $this->product->getAll();

        $fields = $this->product->getFieldsForFormattedList();

        $searchParams = request()->get(ucfirst($this->model)."Search");

        if($searchParams != []){
            $data = $this->product->handlePaginatedListsFilters($data, $searchParams);
        }

        $orderAsc = $searchParams['asc'] ?? 0;

        return view('livewire.admin.products.list', [
            'data' => $data->paginate(10),
            'isOrderAsc' => $orderAsc,
            'model' => $this->model,
            'title' => "Ver Produtos",
            'unfilterableFields' => $this->product->unfilterableFields(),
            'infos' => Helper::flattenArray($fields),
        ]);
    }

    public function editProduct($id)
    {
        $product = $this->product->findOrFail($id);
        $fields = $product->createForm($product);

        return view('livewire.admin.products.edit', [
            'modelData' => $product,
            'model' => 'products',
            'title' => "Editar Produto",
            'fields' => $fields,
        ]);
    }

    public function createProductForm()
    {
        $fields = $this->product->createForm();

        return view('livewire.admin.products.edit', [
            'modelData' => $this->product,
            'model' => 'products',
            'title' => "Editar Produto",
            'fields' => $fields,
        ]);
    }

    public function saveProduct($id = null)
    {
        $product = new Product();

        $data = request()->validate($product->getRules(request()->id));
        $update = $product->updateOrCreate($data);

        if ($update) {
            return redirect()->route('products.view')->with('message', 'Operação realizada com sucesso.');;
        }

        return redirect()->back()->withInput()->with('error_message', "Operação não realizada");
    }



}
