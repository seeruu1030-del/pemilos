<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GAMANANTHA ANVAYA - OSKA 2026/2027 Portal Autentikasi</title>

        {{-- Fonts: Outfit & Urbanist --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Urbanist:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        {{-- Scripts & Styles --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Outfit', 'Urbanist', sans-serif;
            }
        </style>
    </head>
    <body class="h-full font-sans antialiased text-slate-800 bg-slate-50 selection:bg-indigo-600 selection:text-white">
        <div class="min-h-screen flex flex-col justify-center">
            {{ $slot }}
        </div>
    </body>
</html>
