<x-layout>
    <div class="grid grid-cols-4 gap-4 mb-4">
        @foreach($products as $value)
            <div class="p-3 border-solid border border-slate-gray-600">
                <img src="{{$value->image}}" alt="">
                <h2 class="text-lg">{{$value->name}}</h2>
                <h3 class="text-md">{{$value->price}}</h3>
                <h4 class="text-base">{{$value->category_name}}</h4>
                <h5 class="text-sm">{{$value->description}}</h5>

            </div>
        @endforeach

    </div>
    <div class="mt-5">
        {{ $products->links() }}
    </div>
</x-layout>
