<footer class="p-5">
    <div class="flex justify-between flex-wrap gap-1">
        <div class="max-w-1/6">
            <img src="{{ Vite::asset('resources/images/logo.svg') }}">
        </div>
        @foreach($options as $value)
        <div class="max-w-1/4">

            <ul>
                <h4>{{$value['title']}}</h4>
                @foreach($value['content'] as $content)
                    <li>{{$content}}</li>
                @endforeach
            </ul>
        </div>
        @endforeach

    </div>
</footer>
