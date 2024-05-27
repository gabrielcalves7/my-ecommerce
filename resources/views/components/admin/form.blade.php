<div class="bg-white w-full p-5">
    {!! Form::open([
        'method'=> "POST",
        'class'=> "border-1 border-2 border-color-black border-solid p-3",
        'url'=> url(route($formRoute,$modelData->id)),
        'enctype'=>'multipart/form-data'
      ])
   !!}
    <h1 class="text-lg ms-2">
        {{$title}} - {{ $modelData->name }}
    </h1>
    @csrf
    <input type="hidden" name="id" value="{{$modelData->id}}">
    <div class="row flex flex-wrap">
        <div class="p-2 w-1/2">
            <input type="file" onchange="previewImage(event)" name="image">
            <div>
                <img id="imagePreview"
                     src="{{($hasImage = isset($modelData->image) && count($modelData->image) > 0) ?
                            \Illuminate\Support\Facades\Storage::disk('s3')
                                ->temporaryUrl(
                                    $modelData?->image[0]?->url,
                                     now()->addHour()
                                ) :
                            null
                        }}" alt="Image Preview"
                     style="max-width: 300px; max-height: 300px;" {{!$hasImage ? 'class=hidden' : ''}}>
            </div>
        </div>
        <div class="p-2 w-1/2 row flex flex-wrap items-center justify-between">
            @foreach($fields as $value)
                @if($value['type'] !== 'image')
                    <div class="w-1/2 px-2">
                        <label for="{{$name = $value['name']}}">@lang($model.'.'.$value['label'])</label>
                        @if($value['type'] == 'select')
                            {!! Form::select('origin',['' => 'Select collection date'] + $value['options']->toArray(), $value['selected'], [
                                "name"=>$value['name'],
                                "id"=>$value['name'],
                                "class"=>'form-control w-full border border-black',
                                "style"=>"height:28px",
                                ])
                            !!}
                        @else
                            <input
                                    type="{{$value['type']}}"
                                    id="{{$value['name']}}"
                                    class="w-full form-control border border-black"
                                    style="height:28px"
                                    name="{{$value['name']}}"
                                    value="{{$modelData->$name->number ??$modelData->$name}}">

                        @endif
                    </div>
                @endif
                @error($value['name'])
                <span class="text-danger error">{{ "Este campo é obrigatório." }}</span>
                @enderror
            @endforeach
        </div>
    </div>
    <button
            class="ms-2 bg-sky-500 hover:bg-sky-400 text-white mt-2 font-bold py-2 px-4 border-b-4 border-sky-700 hover:border-sky-500 rounded">
        Save
    </button>
    </form>
</div>
