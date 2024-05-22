<div class="">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <header id="main-header" class="">
        <div id="first_part" class="flex justify-between p-5">
            <img src="{{ Vite::asset('resources/images/logo.svg') }}">
        </div>
            <ul class="h-1/1 p-5">
                @if(isset($menu))
                @foreach($menu as $value)
                    <li>
                        <a href="{{$value['url'] ?? '/admin/'.lcfirst($value['name'])}}" class="text-lg">
                            {{$value['name']}}
                            @foreach($value['actions'] as $action)
                                <li>
                                    <a href="{{$action['url']}}">{{$action['name']}}</a>
                                </li>
                        @endforeach
                        </a>
                    </li>
                @endforeach
                        @else
                            nao esta setado os menus
                @endif

            </ul>
    </header>
</div>
