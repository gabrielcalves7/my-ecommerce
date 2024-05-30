    <style>
        td {
            text-align: center
        }
    </style>
    <div class="p-4 bg-white">

        <table class="table-auto bg-white my-5 p-2 container">
            <thead>
            <tr class="border-b-2">
                @foreach($infos as $key => $value)
                    <th>
                        <a
                            href=""
                            onclick="setOrderBy('{{ucfirst($model)}}','{{$value}}','{{isset(request()->get(ucfirst($model).'Search')['order']) && request()->get(ucfirst($model).'Search')['order'] != $value ? 1 : !$isOrderAsc}}')">
                            @lang($model.'.'.$value)
                        </a>
                    </th>
                @endforeach
            </tr>
            </thead>
            <thead>
                <tr class="border-b-2">
                    @foreach($infos as $value)
                        <th>
                            <input
                                    type="text"
                                    id="{{$value}}"
                                    class="w-full form-control border border-gray-300 p-2"
                                    {{in_array($value,$unfilterableFields) ? 'style=opacity:0;display:none disabled' : ''}}
                                    style="height:28px"
                                    name="{{ucfirst($model)."Search[$value]"}}"
                                    value="{{isset(request()->get(ucfirst($model).'Search')[$value]) ? request()->get(ucfirst($model).'Search')[$value] : null}}"
                                    onchange="changePage(this)"
                            />
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr class="border-b-2" style="height:80px">
                    @foreach($infos as $key => $value2)
                        @if($value2 != "actions")
                        <td style="width: calc(100%/{{count($infos)}})">
                            @if($value2 == 'image')
                                <img src="{{($value->$value2 != null && count($value->$value2->toArray()) > 0) ?
                                        \App\Models\AmazonS3Driver::renderImageFromBucket($value->$value2->toArray()[0]['url']) :
                                        Vite::asset('resources/images/noimage.png') }}" class="w-full">
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
