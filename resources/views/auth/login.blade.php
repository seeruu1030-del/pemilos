<x-guest-layout>
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12 bg-slate-50">
        
        {{-- Sisi Kiri: AI Illustration (Pemilihan OSIS SMKS Nurul Islam) & Banner --}}
        <div class="relative hidden lg:flex lg:col-span-6 xl:col-span-7 flex-col justify-between p-12 overflow-hidden bg-slate-950 border-r border-slate-200">
            {{-- Background Image AI Artwork --}}
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/osis_school_illustration.png') }}" 
                     alt="Pemilihan OSIS SMKS Nurul Islam" 
                     class="w-full h-full object-cover object-center scale-105 transition-transform duration-1000 hover:scale-100" />
                {{-- Dark Gradient Vignette Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/75 to-slate-900/40"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-transparent to-slate-950/50"></div>
            </div>

            {{-- Top Header Logo & School Name --}}
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-white/95 backdrop-blur-md p-1 shadow-xl flex items-center justify-center">
                    <div class="w-full h-full bg-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl font-black tracking-wider text-white drop-shadow-lg">GAMANANTHA ANVAYA</h1>
                    <p class="text-xs font-bold text-blue-400 drop-shadow">OSKA 2026/2027 - Portal Pemilihan OSKA</p>
                </div>
            </div>

            {{-- Middle Inspiring Quote & Feature Badges --}}
            <div class="relative z-10 my-auto max-w-xl">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-900/90 backdrop-blur-md border border-blue-500/50 shadow-lg mb-6">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-400 animate-pulse"></span>
                    <span class="text-xs font-black tracking-wider text-blue-200 uppercase">PEMILU OSKA SMKS NURUL ISLAM PERIODE 2026 / 2027</span>
                </div>
                
                <h2 class="text-3xl xl:text-4xl font-black text-white leading-tight mb-4 drop-shadow-lg">
                    Pemilihan Ketua OSIS & MPK SMKS Nurul Islam 2026/2027
                </h2>
                <p class="text-slate-100 text-sm leading-relaxed mb-8 font-medium drop-shadow-md">
                    Selamat datang di Portal Utama Pemilihan OSIS & MPK SMKS Nurul Islam. Kelola proses E-Voting Pemilihan OSIS & MPK Periode 2026/2027 dan pendaftaran siswa secara transparan, akurat, dan terstruktur.
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
                            <h3 class="text-xs font-extrabold text-white">Proteksi Keamanan</h3>
                            <p class="text-[11px] text-slate-300 font-medium">CSRF, XSS & Anti-Brute Force</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 rounded-2xl bg-slate-900/90 border border-slate-700/80 backdrop-blur-md shadow-xl">
                        <div class="w-10 h-10 rounded-xl bg-blue-700 flex items-center justify-center text-white shrink-0 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-white">Multi-Role Akses</h3>
                            <p class="text-[11px] text-slate-300 font-medium">Admin Pemilos & Penerimaan</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Note --}}
            <div class="relative z-10 flex items-center justify-between text-xs text-slate-200 font-semibold drop-shadow">
                <span>&copy; {{ date('Y') }} GAMANANTHA ANVAYA - OSKA 2026/2027.</span>
                <span class="flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-900/90 border border-slate-700 text-blue-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Periode 2026/2027
                </span>
            </div>
        </div>

        {{-- Sisi Kanan: Form Login Area --}}
        <div class="lg:col-span-6 xl:col-span-5 flex items-center justify-center p-6 sm:p-12 bg-slate-50">
            <div class="w-full max-w-md space-y-8">
                
                {{-- Header Mobile Logo & Form Title --}}
                <div>
                    <div class="flex lg:hidden items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 p-0.5 shadow-md">
                            <div class="w-full h-full bg-white rounded-[10px] flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <span class="text-lg font-bold text-slate-900 tracking-wide">GAMANANTHA ANVAYA</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Masuk ke Sistem
                    </h2>
                    <p class="mt-2 text-sm text-slate-600 font-medium">
                        Silakan masukkan kredensial akun administrator OSKA 2026/2027.
                    </p>
                </div>

                {{-- Alert Session Status --}}
                @if (session('status'))
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-3 font-medium">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                {{-- Form Login Container --}}
                <div class="p-8 sm:p-10 rounded-2xl bg-white border border-slate-200 shadow-xl shadow-slate-200/60">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm" autocomplete="off">
                        @csrf

                        {{-- Username Input --}}
                        <div>
                            <label for="username" class="block text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2">
                                Username 
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username') }}" 
                                       required 
                                       autofocus 
                                       autocomplete="username" 
                                       placeholder="Masukkan username"
                                       class="block w-full pl-11 pr-4 py-3 bg-slate-50 border @error('username') border-rose-500 text-rose-900 focus:ring-rose-500 @else border-slate-300 text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-blue-600/20 @enderror rounded-xl text-sm transition duration-200 placeholder-slate-400 focus:outline-none focus:ring-4 font-semibold" />
                            </div>
                            @error('username')
                                <p class="mt-2 text-xs text-rose-600 font-medium flex items-center gap-1.5">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        {{-- Password Input dengan Toggle Visibility --}}
                        <div x-data="{ showPassword: false }">
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                                    Password
                                </label>
                            </div>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input :type="showPassword ? 'text' : 'password'" 
                                       id="password" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password" 
                                       placeholder="••••••••"
                                       class="block w-full pl-11 pr-11 py-3 bg-slate-50 border @error('password') border-rose-500 text-rose-900 focus:ring-rose-500 @else border-slate-300 text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-blue-600/20 @enderror rounded-xl text-sm transition duration-200 placeholder-slate-400 focus:outline-none focus:ring-4 font-semibold" />
                                
                                <button type="button" 
                                        @click="showPassword = !showPassword" 
                                        tabindex="-1"
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                    <template x-if="!showPassword">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </template>
                                    <template x-if="showPassword">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.046 10.046 0 014.133-1.063c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21f-18-18" />
                                        </svg>
                                    </template>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-xs text-rose-600 font-medium flex items-center gap-1.5">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        {{-- Remember Me Checkbox --}}
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                <input id="remember_me" 
                                       type="checkbox" 
                                       name="remember"
                                       class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-600/20 focus:ring-offset-white w-4 h-4 cursor-pointer">
                                <span class="ms-2.5 text-xs text-slate-600 font-semibold select-none hover:text-slate-900 transition-colors">
                                    Ingat Sesi Login Saja
                                </span>
                            </label>
                        </div>

                        {{-- Submit Button --}}
                        <div>
                            <button type="submit" 
                                    class="w-full py-3.5 px-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-extrabold tracking-wider rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/40 focus:outline-none focus:ring-4 focus:ring-blue-600/30 transition duration-200 flex items-center justify-center gap-2 group">
                                <span>Masuk</span>
                                <svg class="w-4 h-4 text-white transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Footer Security Protection Info --}}
                <div class="flex items-center justify-center gap-2 text-xs text-slate-500 font-medium">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span>Dilindungi oleh Proteksi Enkripsi SSL & Rate Limiting System</span>
                </div>

            </div>
        </div>

    </div>
</x-guest-layout>
