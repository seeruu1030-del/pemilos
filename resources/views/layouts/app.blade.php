<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GAMANANTHA ANVAYA - OSKA 2026/2027 Portal Administrator</title>

        {{-- Fonts: Inter & Plus Jakarta Sans --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">

        {{-- Scripts & Styles --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', 'Plus Jakarta Sans', sans-serif;
            }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="h-full font-sans antialiased text-slate-800 bg-[#F4F7FC] selection:bg-blue-600 selection:text-white" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex bg-[#F4F7FC]">
            
            {{-- SIDEBAR CONTAINER --}}
            <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-[#0F264A] text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between border-r border-[#1B3A6B] shadow-2xl"
                   :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
                
                {{-- Sidebar Top: Branding & Navigation --}}
                <div>
                    {{-- Header Logo Branding --}}
                    <div class="h-20 flex items-center justify-between px-6 border-b border-[#1B3A6B] bg-[#0A1A34]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white/30 p-0.5 bg-white shadow-lg">
                                <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div>
                                <h1 class="text-sm font-black tracking-wider text-white leading-tight">GAMANANTHA ANVAYA</h1>
                                <p class="text-[10px] font-bold text-sky-400">OSKA 2026/2027</p>
                            </div>
                        </div>

                        {{-- Mobile Close Button --}}
                        <button @click="sidebarOpen = false" class="lg:hidden text-sky-300 hover:text-white p-1" aria-label="Tutup Sidebar">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Navigation Links --}}
                    <nav class="p-4 space-y-2 text-xs font-bold">
                        <div class="px-3 pt-2 text-[10px] font-black uppercase tracking-widest text-sky-300/60">
                            MENU UTAMA
                        </div>

                        @auth
                            @if(Auth::user()->isAdminPenerimaan())
                                <a href="{{ route('penerimaan.index') }}" 
                                   class="flex items-center justify-between px-4 py-3 rounded-2xl transition duration-200 {{ request()->routeIs('penerimaan.*') ? 'bg-gradient-to-r from-blue-600 to-sky-600 text-white font-black shadow-lg shadow-blue-600/30 border border-sky-400/30' : 'text-sky-100/80 hover:bg-[#1B3A6B]/60 hover:text-white' }}">
                                    <div class="flex items-center gap-3">
                                        <div class="p-1.5 rounded-xl {{ request()->routeIs('penerimaan.*') ? 'bg-white/20' : 'bg-[#152E54]' }}">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <span>Penerimaan OSIS & MPK</span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-full {{ request()->routeIs('penerimaan.*') ? 'bg-white/20 text-white font-black' : 'bg-[#152E54] text-sky-300' }} text-[10px]">Admin-02</span>
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" 
                                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-600 to-sky-600 text-white font-black shadow-lg shadow-blue-600/30 border border-sky-400/30' : 'text-sky-100/80 hover:bg-[#1B3A6B]/60 hover:text-white' }}">
                                    <div class="p-1.5 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-[#152E54]' }}">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </div>
                                    <span>Dashboard Pemilos</span>
                                </a>
                            @endif
                        @endauth
                    </nav>
                </div>

                {{-- Sidebar Bottom: User Profile Info & Logout --}}
                <div class="p-4 border-t border-[#1B3A6B] bg-[#0A1A34]/80">
                    @auth
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <div class="w-9 h-9 rounded-2xl bg-gradient-to-tr from-sky-400 to-blue-600 text-white font-black flex items-center justify-center text-xs shadow-md shrink-0">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-xs font-black text-white truncate max-w-[120px]">{{ Auth::user()->name }}</p>
                                    <p class="text-[10px] text-sky-400 font-semibold truncate">{{ Auth::user()->role_label }}</p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                                @csrf
                                <button type="submit" title="Keluar / Logout" class="p-2 rounded-xl text-sky-300 hover:text-rose-400 hover:bg-[#1B3A6B] transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>

            </aside>

            {{-- MAIN CONTENT WRAPPER --}}
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                
                {{-- TOP HEADER BAR --}}
                <header class="bg-gradient-to-r from-[#1E5BB8] via-[#1A4F9C] to-[#153F7C] text-white border-b border-blue-900/40 min-h-[4.5rem] py-3 flex items-center justify-between px-6 sm:px-8 shadow-md">
                    <div class="flex items-center gap-4">
                        {{-- Mobile Menu Toggle Button --}}
                        <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-sky-100 hover:bg-white/10" aria-label="Buka Sidebar">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        {{-- Page Header Title Passed from Views --}}
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>

                    {{-- Top Header Right Badges --}}
                    <div class="hidden sm:flex items-center gap-3 text-xs">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-white font-extrabold border border-white/20 shadow-sm">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Sistem Aktif
                        </span>
                    </div>
                </header>

                {{-- MAIN PAGE CONTENT SLOT --}}
                <main class="flex-1 overflow-y-auto bg-[#F4F7FC]">
                    {{ $slot }}
                </main>

            </div>

        </div>
    </body>
</html>
