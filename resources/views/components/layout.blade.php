<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="">
    @livewire('header')
        <div class="p-5">
            {{ $slot }}
        </div>
            @livewire('footer')

    </body>
    @livewireScripts
</script>
</html>
