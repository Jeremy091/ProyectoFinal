<!doctype html>
<html lang="{{ Config::get('app.locale') }}" {!! config('tablar.layout') == 'rtl' ? 'dir="rtl"' : '' !!}>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    {{-- Custom Meta Tags --}}
    @yield('meta_tags')
    {{-- Title --}}
    <title>
        @yield('title_prefix', config('tablar.title_prefix', ''))
        @yield('title', config('tablar.title', 'Tablar'))
        @yield('title_postfix', config('tablar.title_postfix', ''))
    </title>

    <!-- CSS/JS files -->
    @if (config('tablar', 'vite'))
        @vite('resources/js/app.js')
    @endif

    {{-- Livewire Styles --}}
    @if (config('tablar.livewire'))
        @livewireStyles
    @endif

    {{-- Custom Stylesheets (post Tablar) --}}
    @yield('tablar_css')

</head>
@yield('body')
@include('tablar::extra.modal')

{{-- Livewire Script --}}
@if (config('tablar.livewire'))
    @livewireScripts
@endif

@yield('tablar_js')
{{-- <footer
    style="background-color: black; color: white; text-align: center; padding: 20px 0; font-size: 20px; height: 100px;">
    Copyright &copy; 2024 - MegaUp
</footer> --}}

</html>
