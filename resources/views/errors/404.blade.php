<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>404 - Halaman Tidak Ditemukan | SMKS Nurul Islam</title>
        
        {{-- Fonts: Outfit & Urbanist --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Urbanist:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            body {
                font-family: 'Outfit', 'Urbanist', sans-serif;
            }
        </style>
    </head>
    <body class="h-full font-sans antialiased text-slate-800 bg-slate-50 selection:bg-blue-600 selection:text-white">
        
        <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12 bg-slate-50">
            
            {{-- Sisi Kiri: AI Illustration (Satpam Keamanan Sekolah Indonesia) & Branding Banner --}}
            <div class="relative hidden lg:flex lg:col-span-6 xl:col-span-7 flex-col justify-between p-12 overflow-hidden bg-slate-950 border-r border-slate-200">
                {{-- Background Image AI Artwork --}}
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/security_404_illustration.png') }}" 
                          alt="Satpam Keamanan SMKS Nurul Islam" 
                          class="w-full h-full object-cover object-center scale-105 transition-transform duration-1000 hover:scale-100" />
                    {{-- Dark Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/75 to-slate-900/40"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-transparent to-slate-950/50"></div>
                </div>

                {{-- Top Header Logo & School Name --}}
                <div class="relative z-10 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white/80 p-0.5 bg-white shadow-xl flex items-center justify-center">
                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                    </div>
                    <div>
                        <h1 class="text-xl font-black tracking-wider text-white drop-shadow-lg">GAMANANTHA ANVAYA</h1>
                        <p class="text-xs font-bold text-blue-400 drop-shadow">OSKA 2026/2027 - Security & Access Control</p>
                    </div>
                </div>

                {{-- Middle Quote & Feature Badges --}}
                <div class="relative z-10 my-auto max-w-xl">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-900/90 backdrop-blur-md border border-blue-500/50 shadow-lg mb-6">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-400 animate-pulse"></span>
                        <span class="text-xs font-black tracking-wider text-blue-200 uppercase">SATUAN KEAMANAN DIGITAL SEKOLAH</span>
                    </div>
                    
                    <h2 class="text-3xl xl:text-4xl font-black text-white leading-tight mb-4 drop-shadow-lg">
                        Proteksi Akses & Keamanan Sistem SMKS Nurul Islam
                    </h2>
                    <p class="text-slate-100 text-sm leading-relaxed mb-8 font-medium drop-shadow-md">
                        Sistem keamanan terintegrasi menjaga seluruh rute dan data aplikasi agar senantiasa aman, stabil, serta terhindar dari akses tidak sah.
                    </p>

                    {{-- Key Feature Badges --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/90 border border-slate-700/80 backdrop-blur-md shadow-xl">
                            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shrink-0 shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-extrabold text-white">Security Guard Active</h3>
                                <p class="text-[11px] text-slate-300 font-medium">Monitoring Rute Real-time</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/90 border border-slate-700/80 backdrop-blur-md shadow-xl">
                            <div class="w-10 h-10 rounded-xl bg-blue-700 flex items-center justify-center text-white shrink-0 shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-extrabold text-white">Enkripsi Berlapis</h3>
                                <p class="text-[11px] text-slate-300 font-medium">SSL & CSRF Protection</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer Note --}}
                <div class="relative z-10 flex items-center justify-between text-xs text-slate-200 font-semibold drop-shadow">
                    <span>&copy; {{ date('Y') }} GAMANANTHA ANVAYA - OSKA 2026/2027.</span>
                    <span class="flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-900/90 border border-slate-700 text-blue-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Satpam Guard Standby
                    </span>
                </div>
            </div>

            {{-- Sisi Kanan: Form / Message Content Area --}}
            <div class="lg:col-span-6 xl:col-span-5 flex items-center justify-center p-6 sm:p-12 bg-slate-50">
                <div class="w-full max-w-md space-y-8 text-center sm:text-left">
                    
                    {{-- Header Mobile Logo --}}
                    <div class="flex lg:hidden items-center justify-center sm:justify-start gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full overflow-hidden border border-slate-200 p-0.5 bg-white shadow-md">
                            <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                        </div>
                        <span class="text-lg font-bold text-slate-900 tracking-wide">GAMANANTHA ANVAYA</span>
                    </div>

                    {{-- 404 Large Badge --}}
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-2xl bg-blue-50 border border-blue-200 text-blue-700 shadow-sm">
                        <span class="text-2xl font-black">404</span>
                        <span class="text-xs font-bold uppercase tracking-wider border-l border-blue-200 pl-3">Halaman Tidak Ditemukan</span>
                    </div>

                    {{-- Title & Explanation --}}
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                            Waduh, Halaman Tidak Ada!
                        </h2>
                        <p class="mt-3 text-sm text-slate-600 font-medium leading-relaxed">
                            Maaf, halaman yang Anda cari tidak terdaftar di dalam rute sistem SMKS Nurul Islam atau alamat URL yang Anda tuju salah.
                        </p>
                    </div>

                    {{-- 404 Action Card & Navigation Button --}}
                    <div class="p-8 sm:p-10 rounded-2xl bg-white border border-slate-200 shadow-xl shadow-slate-200/60 space-y-6">
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-600 font-medium flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Pastikan ejaan URL yang Anda masukkan sudah benar, atau kembali ke halaman utama untuk melanjutkan.</span>
                        </div>

                        <div>
                            <a href="{{ route('home') }}" 
                               class="w-full py-3.5 px-6 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-extrabold tracking-wider text-sm rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/40 focus:outline-none focus:ring-4 focus:ring-blue-600/30 transition duration-200 flex items-center justify-center gap-2 group">
                                <svg class="w-4 h-4 text-white transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                <span>Kembali ke Halaman Utama</span>
                            </a>
                        </div>
                    </div>

                    {{-- Security Protection Footer --}}
                    <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-slate-500 font-medium">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Protected by Satpam Guard & Encrypted Security System</span>
                    </div>

                </div>
            </div>

        </div>
    </body>
</html>
