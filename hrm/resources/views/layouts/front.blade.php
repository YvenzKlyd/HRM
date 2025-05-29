<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/black.png') }}">
        
        <title>@yield('title', 'Hotel Transylvania')</title>

        {{-- meta daw --}}
        @yield('meta')

        {{-- style --}}
        @yield('style')
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


    </head>
    <body class="font-sans text-gray-900 antialiased">
        
        {{-- include nav --}}
            @include('layouts.nav')
        {{-- content --}}
            @yield('content')

        {{-- script --}}
            @yield('script')
            
    </body>
</html>
