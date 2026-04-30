<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&display=swap"
        rel="stylesheet">
    <title>{{ $title ?? config('app.name') }}</title>
    @livewireStyles
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('styles')
</head>
<body class="bg-main bg-repeat min-h-screen flex flex-col" style="background-image: url({{ asset('icons/s1.svg') }});">

<livewire:auth.register/>
<livewire:auth.login/>
<livewire:booking/>

<x-header/>

<main @class(['container' => !request()->routeIs('menus.show'), 'mx-auto grow'])>
    {{ $slot }}
</main>

@if(!request()->routeIs('menus.show'))
    <x-footer/>
@endif

@livewireScripts
<script src="https://unpkg.com/imask"></script>
<script src="{{ asset('js/phone-mask.js') }}"></script>
@stack('scripts')
</body>
</html>
