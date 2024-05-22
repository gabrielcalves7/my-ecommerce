<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="{{ Vite::asset('resources/js/app.js') }}" type="module"></script>
        @livewireStyles
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="">
        @livewire('header',['categories'])
        <div class="p-5">
            {{ $slot }}
        </div>
        @livewire('footer',['categories'])

    </body>
    @livewireScripts
</script>
<script>
    @if(isset($message) || session()->has('message'))
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($message['success']))
        toastr.success({{$message}});
        @elseif(isset($message['info']))
        toastr.info({{$message}});
        @elseif(isset($message['warning']))
        toastr.warning({{$message}})
        @else
        toastr.{{ session('type') }}('{{session('message')}}')
        @endif
    });
    @else
        nomesage
    @endif
</script>
</html>
