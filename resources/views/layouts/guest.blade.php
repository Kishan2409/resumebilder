<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <title>{{ Helper::Settings() == null ? 'TEST' : Helper::Settings()->title }} | @yield('title')</title>

    <link rel="icon"
        href="{{ asset(!empty(Helper::Settings()->favicon) ? 'public/storage/favicon/' . Helper::Settings()->favicon : '') }}"
        type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('public/build/assets/app-530f2d6e.css') }}" rel="stylesheet" />
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            @php
                $path = Helper::Settings() ? asset('public/storage/logo/' . Helper::Settings()->logo) : asset('public/admin/dist/img/no_image_available.png');
            @endphp
            <a href="{{ route('welcome') }}">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <img src="{{ $path }}" alt="" class="w-20 h-20">
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
<script src="{{ asset('public/build/assets/app-b1941ff8.js') }}"></script>

</html>
