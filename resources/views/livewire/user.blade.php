<x-layout>
    <div class="grid grid-cols-4 gap-4 mb-4">
        @foreach($products as $value)

            <div class="p-3 border-solid border border-slate-gray-600">
                <img src="{{$value->name}}" alt="">
                <h2 class="text-lg">{{$value->email}}</h2>
                <h3 class="text-md">{{$value->user_type}}</h3>
            </div>
        @endforeach

    </div>
    <div class="mt-5">
        {{ $products->links() }}
    </div>
</x-layout>
