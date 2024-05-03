<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <header id="main-header" class="bg-sky-400 p-5">
        <div id="first_part" class="flex justify-between mb-4">
            <img src="{{ Vite::asset('resources/images/logo.svg') }}">
            <input type="search">
        </div>
        <ul class="grid grid-flow-col auto-cols-max gap-4">
            @foreach($categories as $value)

                <li>
                    <a href="{{$value['url'] ?? '/'.lcfirst($value['name'])}}" class="text-lg">
                        {{$value['name']}}
                    </a>
                </li>
            @endforeach
        </ul>
    </header>
</div>
