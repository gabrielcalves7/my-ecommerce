<x-admin-layout :title="$title">

    <h1 class="text-lg">
        Editar Produto - {{ $product->name }}

{{--        <form wire:submit="save_product">--}}
        <form action="{{route('save_product',$product->id)}}" method="POST">
            @csrf
            <div class="row flex">
                <div class="" style="width: 50%">
                    <img src="{{$product->image}}" alt="">
                    <input type="hidden" name="image" value="{{$product->image}}">
                    <input type="hidden" name="id" value="{{$product->id}}">
                </div>
                <div class="">
                    <div class="p-4">
                        <label for="name">name:</label>
                        <input type="text" id="name" class="form-control border border-black" name="name" value="{{$product->name}}">
                    </div>
                    <div class="p-4">
                        <label for="price">price:</label>
                        <input type="text" id="price" class="form-control border border-black" name="price" value="{{$product->price}}">
                    </div>
                    <div class="p-4">
                        <label for="category">category:</label>
                        <select name="category" id="category">
                            @foreach($product as $key=>$value)
                                <option value="{{$product->category}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-4">
                        <label for="description">description:</label>
                        <input type="text" id="description" class="form-control border border-black" name="description" value="{{$product->description}}">
                    </div>

                    <button type="submit">Save</button>
                </div>
            </div>
        </form>
    </h1>
</x-admin-layout>
