    <style>
        td {
            text-align: center
        }
    </style>
    <div class="p-4 bg-white">

        <table class="table-auto bg-white my-5 container">
            <thead>
            <tr class="border-b-2">
                @foreach($infos as $key=>$value)
                    <th>@lang($langFile.'.'.$value)</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr class="border-b-2" style="height:80px;">
                    @foreach($infos as $key => $value2)
                        @if($value2 != "actions")
                        <td>
                            @if($value2 == 'image')
                                <img src="{{$value->$value2}}" style="max-height: 50px">
                            @else
                                <h2 class="text-lg">{{$value->$value2}}</h2>
                            @endif
                        </td>
                        @endif
                    @endforeach
                    <td>
                        <a href="{{route($editRouteName,$value->id)}}">Ver</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $data->links() }}

    </div>
