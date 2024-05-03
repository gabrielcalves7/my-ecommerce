<x-admin-layout :title="$title">
    <style>
        td{text-align: center}
    </style>
    <div class="p-4 bg-white">

        <table class="table-auto bg-white my-5 container">
            <thead>
            <tr class="border-b-2">
                @foreach($infos as $key=>$value)
                    <th>@lang('users.'.$value)</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr class="border-b-2" style="height:80px;">
                    <td>
                        <h2 class="text-lg">{{$value->name}}</h2>
                    </td>
                    <td>
                        <h2 class="text-lg">{{$value->email}}</h2>
                    </td>
                    <td>
                        <h3 class="text-md">{{$value->user_type}}</h3>
                    </td>
                    <td>
                        <h3 class="text-md">{{$value->mainPhone->number ?? '-'}}</h3>
                    </td>
                    <td>
                        <h3 class="text-md">{{$value->birthDate ?? '-'}}</h3>
                    </td>
                    <td>
                        <h3 class="text-md">{{$value->document ?? '-'}}</h3>
                    </td>
                    <td>
                        <a href="{{route('single_user',$value->id)}}">Ver</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $data->links() }}

    </div>

</x-admin-layout>
