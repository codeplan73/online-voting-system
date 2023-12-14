<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    {{-- <nav class="bg-red-400 h-20">

    </nav> --}}
    <header class="bg-slate-900 text-white font-extrabold font-mono text-center text-2xl  py-5">
        <h4 class="">Online Voting System</h4>
    </header>
    @include('layouts.guest-nav')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <img src="/img/login.png" class="h-28 w-28 rounded-full" alt="">
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    <footer class="bg-gray-800 text-white flex justify-evenly py-6">
        <div class="text-center text-sm flex flex-col gap-1">
            <h4 class="text-lg font-bold mb-2">Online Voting System</h4>
            <p>House Number <br /> Street ABC, City CDE, State FGH UK</p>
            <p>Phone: +14832399239</p>
            <p>Email: info@onlinvotingsystem.com</p>
        </div>
        <div class="text-center text-sm flex flex-col">
            <h4 class="text-lg font-bold mb-2">Quik Links</h4>
            <a href="/login" class="underline mb-1">Voters Section</a>
            <a href="/candidate-login" class="underline">Candidate Section</a>
        </div>
    </footer>
</body>

</html>
