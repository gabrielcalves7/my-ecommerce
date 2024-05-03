<x-admin-layout :title="$title">

<div class="bg-white w-full p-5">
    {!! Form::open([
        "action"=>"{{route('save_user',$product->id)}}",
        "method"=>"POST",
        "class"=>"border-1 border-2 border-color-black border-solid p-3",
        'url'=> url(route('save_user',$product->id)),
        'class' => ''
      ])
   !!}

        <form
            action="{{route('save_user',$product->id)}}"
            method="POST"
            class="border-1 border-2 border-color-black border-solid p-3"
        >
            <h1 class="text-lg ms-2">
                {{$title}} - {{ $product->name }}
            </h1>
            @csrf
            <input type="hidden" name="id" value="{{$product->id}}">

            <div class="row flex flex-wrap">
                    @foreach($fields as $value)
                    <div class="p-2 w-1/4">
                        <label for="{{$name = $value['name']}}">@lang('users.'.$value['label'])</label>
                        <br>
                        @if($value['type'] == 'select')
                            {!! Form::select('origin',['' => 'Select collection date'] + $value['options']->toArray(), $value['selected'], [
                                "name"=>$value['name'],
                                "id"=>$value['name'],
                                "class"=>'form-control w-full border border-black',
                                "style"=>"height:28px",
                                ])
                            !!}

{{--                            <select--}}
{{--                                name="{{$value['name']}}"--}}
{{--                                id="{{$value['name']}}"--}}
{{--                                class='form-control w-full border border-black'--}}
{{--                                style="height:28px"--}}
{{--                                required--}}
{{--                            >--}}
{{--                                <option value="">Select collection date</option>--}}
{{--                                @foreach($value['options'] as $option)--}}
{{--                                    <option value="{{$option->id}}">{{$option->name}}</option>--}}

{{--                                @endforeach--}}
                            </select>
                        @else
                            <input
                                type="{{$value['type']}}"
                                id="{{$value['name']}}"
                                class="w-full form-control border border-black"
                                style="height:28px"
                                name="{{$value['name']}}"
                                value="{{$product->$name}}
                           ">
                        @endif

                        @error($value['name']) <span class="text-danger error">{{ "Este campo é obrigatório." }}</span>@enderror
                    </div>
                    @endforeach
            </div>
            <button class="ms-2 bg-sky-500 hover:bg-sky-400 text-white mt-2 font-bold py-2 px-4 border-b-4 border-sky-700 hover:border-sky-500 rounded">
                Save
            </button>
        </form>
</div>
</x-admin-layout>
