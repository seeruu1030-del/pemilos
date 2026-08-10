<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#F4F7FC]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GAMANANTHA ANVAYA - E-Voting Pemilos OSKA 2026/2027</title>

        {{-- Fonts: Outfit & Urbanist --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Urbanist:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        {{-- Scripts & Styles --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            body {
                font-family: 'Outfit', 'Urbanist', sans-serif;
            }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="min-h-full font-sans antialiased text-slate-800 bg-[#F4F7FC] selection:bg-blue-600 selection:text-white flex flex-col">
        
        {{-- FULL-WIDTH TOP HEADER NAVIGATION BAR (NO SIDEBAR) --}}
        <header class="bg-gradient-to-r from-[#0F264A] via-[#153F7C] to-[#1E5BB8] text-white shadow-xl sticky top-0 z-40 border-b border-sky-400/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
                
                {{-- Left: Brand Logo & Title --}}
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-11 h-11 rounded-full overflow-hidden border-2 border-white/40 p-0.5 bg-white shadow-xl shrink-0">
                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-base sm:text-lg font-black tracking-wider text-white leading-tight">GAMANANTHA ANVAYA</h1>
                            <span class="px-2 py-0.5 rounded bg-sky-400/20 border border-sky-300/30 text-[10px] font-extrabold text-sky-200 uppercase tracking-widest hidden sm:inline-block">
                                {{ Auth::user() && Auth::user()->isAdminMpk() ? 'E-VOTING MPK' : 'E-VOTING OSIS' }}
                            </span>
                        </div>
                        <p class="text-[11px] font-bold text-sky-300">
                            OSKA 2026/2027 • {{ Auth::user() && Auth::user()->isAdminMpk() ? 'Pemilih Kategori Admin 03 (MPK)' : 'Pemilih Kategori Admin 01 (OSIS)' }}
                        </p>
                    </div>
                </div>

                {{-- Right: Navigation Action Links & User Info --}}
                <div class="flex items-center gap-3">
                    @auth
                        <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/10 border border-white/20 text-xs">
                            <div class="w-7 h-7 rounded-lg bg-sky-400 text-[#0F264A] font-black flex items-center justify-center text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="text-left">
                                <p class="font-extrabold text-white leading-tight text-xs">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-sky-300 font-semibold">Panitia Pemilos</p>
                            </div>
                        </div>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                            @csrf
                            <button type="submit" title="Keluar / Logout" class="p-2.5 rounded-xl bg-white/10 hover:bg-rose-600/80 text-sky-200 hover:text-white transition duration-200 flex items-center gap-1.5 text-xs font-bold border border-white/10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span class="hidden sm:inline">Keluar</span>
                            </button>
                        </form>
                    @endauth
                </div>

            </div>
        </header>

        {{-- MAIN CONTENT AREA (FULL SCREEN WIDTH) --}}
        <main class="flex-1">
            {{ $slot }}
        </main>

        {{-- FOOTER --}}
        <footer class="bg-[#0A1A34] text-slate-400 border-t border-[#1B3A6B] py-4 text-center text-xs">
            <div class="max-w-7xl mx-auto px-4">
                <p class="font-semibold text-slate-300">
                    &copy; 2026/2027 GAMANANTHA ANVAYA • Pemilihan Ketua & Wakil Ketua OSIS
                </p>
            </div>
        </footer>

    </body>
</html>
