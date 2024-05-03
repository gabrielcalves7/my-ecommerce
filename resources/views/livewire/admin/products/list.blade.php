<x-admin-layout :title="$title">
    <style>
        td{text-align: center}
    </style>
    <div class="p-4 bg-white">

        <table class="table-auto bg-white my-5">
            <thead>
            <tr class="border-b-2">
                @foreach($infos as $key=>$value)

                    <th>{{$value}}</th>

                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($products as $value)

                <tr class="border-b-2" style="height:80px;">
                    <td>
                        <img src="{{$value->image}}" style="max-height: 50px">
                    </td>
                    <td>
                        <h2 class="text-lg">{{$value->name}}</h2>
                    </td>
                    <td>
                        <h3 class="text-md">{{$value->price}}</h3>
                    </td>
                    <td>
                        <h4 class="text-base">{{$value->category_name}}</h4>
                    </td>
                    <td>
                        <h5 class="text-sm">{{$value->description}}</h5>
                    </td>
                    <td>
                        <a href="{{route('single_product',$value->id)}}">Ver</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}

    </div>

</x-admin-layout>
