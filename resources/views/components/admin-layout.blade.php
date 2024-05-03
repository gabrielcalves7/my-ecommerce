<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Page Title' }}</title>
        <script src="{{ Vite::asset('resources/js/app.js') }}" type="module"></script>
    </head>
    <body class="flex flex-col min-h-screen justify-between">
            <div class="flex">
                <div class="w-1/6 bg-sky-400">
                    @livewire('AdminHeader')
                </div>
                <div class="w-full">
                    <div class="bg-white w-full p-5">
                    {{ $slot }}
                    </div>
                </div>
            </div>

            @livewire('footer')

    </body>
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
