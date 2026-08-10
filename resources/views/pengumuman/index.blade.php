<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth bg-[#F4F7FC]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Portal Resmi Pengumuman Hasil Seleksi OSIS & MPK GAMANANTHA ANVAYA Periode 2026/2027">
        
        <title>Hasil Seleksi OSIS & MPK 2026/2027 | OSKA 2026/2027</title>
        
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
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="min-h-full font-sans antialiased text-slate-800 bg-[#F4F7FC] flex flex-col selection:bg-blue-600 selection:text-white">
        
        {{-- HEADER BANNER (OCEAN BLUE DAPODIK THEME) --}}
        <header class="bg-gradient-to-r from-[#1E5BB8] via-[#1A4F9C] to-[#153F7C] text-white pt-6 pb-16 sm:pt-8 sm:pb-24 px-3 sm:px-6 relative overflow-hidden border-b border-blue-900/40 shadow-lg">
            {{-- Subtle Background Pattern Accent --}}
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>

            <div class="max-w-4xl mx-auto text-center space-y-2.5 relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full bg-white/10 border border-white/20 text-[10px] sm:text-[11px] font-black text-sky-200 tracking-wide uppercase backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Portal Pengumuman OSIS & MPK
                </div>

                <h1 class="text-xl sm:text-4xl font-black tracking-tight text-white drop-shadow-md">
                    Pengumuman Hasil Seleksi OSIS & MPK
                </h1>
                
                <p class="text-[11px] sm:text-sm text-sky-100 max-w-xl mx-auto font-medium leading-relaxed drop-shadow">
                    Masukkan nama lengkap dan tanggal lahir calon peserta untuk melihat hasil kelulusan seleksi.
                </p>

                <div class="pt-0.5">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-[11px] sm:text-xs font-extrabold text-white transition shadow-sm">
                        <svg class="w-3.5 h-3.5 text-sky-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali ke Beranda Utama</span>
                    </a>
                </div>
            </div>
        </header>

        {{-- MAIN FLOATING CONTENT AREA --}}
        <main class="relative z-20 {{ isset($searched) ? 'max-w-5xl sm:max-w-6xl' : 'max-w-2xl' }} mx-auto px-2.5 sm:px-6 -mt-12 sm:-mt-20 mb-10 sm:mb-16 w-full transition-all duration-300 space-y-6">

            {{-- CASE 1: PROSES REKRUTMEN SEDANG BERLANGSUNG --}}
            @if($mode === 'in_progress')
                
                <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-10 shadow-xl space-y-6 text-center animate-fade-in">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden border-2 border-amber-300 p-0.5 bg-white shadow-md mx-auto">
                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                    </div>

                    <div class="space-y-2">
                        <span class="px-3.5 py-1 rounded-full bg-amber-100 text-amber-800 text-[11px] font-black uppercase tracking-wider border border-amber-200">
                            Status: Rekrutmen Berlangsung
                        </span>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight pt-2">
                            Proses Rekrutmen Sedang Berlangsung
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 font-medium leading-relaxed max-w-md mx-auto">
                            Pengumuman hasil kelulusan seleksi calon pengurus OSIS & MPK periode 2026/2027 belum dibuka oleh panitia.
                        </p>
                    </div>

                    <div class="p-4 sm:p-5 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 font-semibold leading-relaxed shadow-inner flex items-start gap-3 text-left">
                        <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.684A1.76 1.76 0 013 12.002V9.998a1.76 1.76 0 012.436-1.682l10.87-4.148A1.76 1.76 0 0118 5.882V17.12a1.76 1.76 0 01-1.694 1.714l-10.87-5.15z" />
                        </svg>
                        <div>
                            <strong class="text-amber-900 font-black">Informasi Panitia:</strong><br>
                            Proses rekrutmen sedang berlangsung. Kembali lagi nanti saat pengumuman penerimaan kelulusan diinformasikan lagi oleh panitia sekolah.
                        </div>
                    </div>
                </div>

            {{-- CASE 2: HITUNGAN MUNDUR (COUNTDOWN TIMER) --}}
            @elseif($mode === 'countdown')

                <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-10 shadow-xl space-y-6 sm:space-y-8 text-center animate-fade-in"
                     x-data="{
                         target: new Date('{{ $targetTimestamp }}').getTime(),
                         now: new Date().getTime(),
                         days: 0, hours: 0, minutes: 0, seconds: 0,
                         updateTimer() {
                             this.now = new Date().getTime();
                             let distance = this.target - this.now;
                             if (distance <= 0) {
                                 window.location.reload();
                                 return;
                             }
                             this.days = Math.floor(distance / (1000 * 60 * 60 * 24));
                             this.hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                             this.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                             this.seconds = Math.floor((distance % (1000 * 60)) / 1000);
                         }
                     }"
                     x-init="updateTimer(); setInterval(() => updateTimer(), 1000)">
                    
                    {{-- Logo Badge --}}
                    <div class="flex items-center justify-center gap-3">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden border-2 border-blue-600 p-0.5 bg-white shadow-md">
                            <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="text-left">
                            <h3 class="text-base font-black text-slate-900 leading-none tracking-wider">GAMANANTHA ANVAYA</h3>
                            <p class="text-xs font-bold text-[#1E5BB8] mt-1">Pengumuman Kelulusan OSIS & MPK</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h2 class="text-xl sm:text-3xl font-black text-slate-900 tracking-tight">
                            Pengumuman Kelulusan Segera Dibuka
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 font-medium">
                            Akses pencarian hasil kelulusan seleksi akan dibuka secara otomatis pada jadwal berikut:
                        </p>
                        @if($datetime)
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-blue-50 text-[#1E5BB8] text-xs font-black border border-blue-200">
                                <svg class="w-4 h-4 text-[#1E5BB8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($datetime)->translatedFormat('l, d F Y - H:i') }} WIB</span>
                            </span>
                        @endif
                    </div>

                    {{-- LIVE TICKING COUNTDOWN CARDS --}}
                    <div class="grid grid-cols-4 gap-2 sm:gap-3">
                        <div class="bg-slate-900 border border-slate-800 p-2.5 sm:p-4 rounded-2xl shadow-md">
                            <span class="text-lg sm:text-4xl font-black font-mono block text-white" x-text="String(days).padStart(2, '0')">00</span>
                            <span class="text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 block">Hari</span>
                        </div>
                        <div class="bg-slate-900 border border-slate-800 p-2.5 sm:p-4 rounded-2xl shadow-md">
                            <span class="text-lg sm:text-4xl font-black font-mono block text-white" x-text="String(hours).padStart(2, '0')">00</span>
                            <span class="text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 block">Jam</span>
                        </div>
                        <div class="bg-slate-900 border border-slate-800 p-2.5 sm:p-4 rounded-2xl shadow-md">
                            <span class="text-lg sm:text-4xl font-black font-mono block text-white" x-text="String(minutes).padStart(2, '0')">00</span>
                            <span class="text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 block">Menit</span>
                        </div>
                        <div class="bg-slate-900 border border-slate-800 p-2.5 sm:p-4 rounded-2xl shadow-md">
                            <span class="text-lg sm:text-4xl font-black font-mono block text-white" x-text="String(seconds).padStart(2, '0')">00</span>
                            <span class="text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 block">Detik</span>
                        </div>
                    </div>

                    <div class="p-3.5 rounded-xl bg-slate-100 border border-slate-200 text-[11px] text-slate-600 font-medium flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-slate-500 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Halaman ini akan memperbarui secara otomatis saat hitungan mundur selesai.</span>
                    </div>
                </div>

            {{-- CASE 3: PENGUMUMAN DIBUKA (HASIL SELEKSI ATAU FORM CEK HASIL) --}}
            @else

                {{-- JIKA BELUM CARI (ATAU SUDAH KLIK CEK NAMA LAIN): TAMPILKAN FORM CEK HASIL --}}
                @if(!isset($searched))

                    <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-10 shadow-xl space-y-6 sm:space-y-8 animate-fade-in">
                        
                        {{-- Card Header Logo OSIS MPK --}}
                        <div class="flex items-center gap-3 sm:gap-4 border-b border-slate-100 pb-5">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden border-2 border-blue-600 p-0.5 bg-white shadow-md shrink-0">
                                <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div class="space-y-1">
                                <h2 class="text-lg sm:text-2xl font-black text-slate-900 tracking-tight uppercase">
                                    HASIL SELEKSI OSIS & MPK 2026/2027
                                </h2>
                                <p class="text-xs text-slate-500 font-semibold">
                                    Form Pencarian Kelulusan Calon Pengurus
                                </p>
                            </div>
                        </div>

                        {{-- Form Cek Hasil --}}
                        <form method="POST" action="{{ route('pengumuman.check') }}" class="space-y-5">
                            @csrf

                            {{-- Input Nama Lengkap --}}
                            <div>
                                <label for="full_name" class="block text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2">
                                    Nama Lengkap Calon *
                                </label>
                                <input type="text" 
                                       id="full_name" 
                                       name="full_name" 
                                       value="{{ old('full_name', $searchName ?? '') }}" 
                                       required 
                                       autofocus
                                       placeholder="CONTOH: AHMAD FAUZI" 
                                       class="w-full py-3.5 px-4 bg-slate-50 border border-slate-300 rounded-xl text-xs sm:text-sm font-bold text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:outline-none transition uppercase" />
                                @error('full_name')
                                    <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Input Split Tanggal Lahir (Tanggal / Bulan / Tahun) --}}
                            <div>
                                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2">
                                    Tanggal Lahir (Tanggal / Bulan / Tahun) *
                                </label>
                                
                                <div class="flex items-center gap-1.5 sm:gap-2">
                                    {{-- Tanggal --}}
                                    <div class="flex-1">
                                        <input type="number" 
                                               name="birth_day" 
                                               inputmode="numeric"
                                               pattern="[0-9]*"
                                               min="1" 
                                               max="31" 
                                               value="{{ old('birth_day', $searchDay ?? '') }}" 
                                               required 
                                               placeholder="Tanggal (DD)" 
                                               class="w-full py-3.5 px-2 sm:px-3 bg-slate-50 border border-slate-300 rounded-xl text-center font-bold text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:outline-none transition" />
                                    </div>

                                    <span class="text-slate-400 font-black text-base sm:text-lg shrink-0">/</span>

                                    {{-- Bulan --}}
                                    <div class="flex-1">
                                        <input type="number" 
                                               name="birth_month" 
                                               inputmode="numeric"
                                               pattern="[0-9]*"
                                               min="1" 
                                               max="12" 
                                               value="{{ old('birth_month', $searchMonth ?? '') }}" 
                                               required 
                                               placeholder="Bulan (MM)" 
                                               class="w-full py-3.5 px-2 sm:px-3 bg-slate-50 border border-slate-300 rounded-xl text-center font-bold text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:outline-none transition" />
                                    </div>

                                    <span class="text-slate-400 font-black text-base sm:text-lg shrink-0">/</span>

                                    {{-- Tahun --}}
                                    <div class="flex-1">
                                        <input type="number" 
                                               name="birth_year" 
                                               inputmode="numeric"
                                               pattern="[0-9]*"
                                               min="1990" 
                                               max="2026" 
                                               value="{{ old('birth_year', $searchYear ?? '') }}" 
                                               required 
                                               placeholder="Tahun (YYYY)" 
                                               class="w-full py-3.5 px-2 sm:px-3 bg-slate-50 border border-slate-300 rounded-xl text-center font-bold text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:outline-none transition" />
                                    </div>
                                </div>
                                @error('birth_date')
                                    <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- PANDUAN PENGISIAN --}}
                            <div class="p-3.5 sm:p-4 rounded-2xl bg-blue-50 border border-blue-200 text-xs text-blue-950 space-y-1.5 font-medium">
                                <p class="font-extrabold text-[#1E5BB8] flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#1E5BB8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Panduan Pengisian:</span>
                                </p>
                                <ul class="list-disc list-inside space-y-1 text-[11px] text-slate-700 leading-relaxed">
                                    <li><strong>Nama Lengkap:</strong> Boleh menggunakan huruf KAPITAL atau kecil (Contoh: <code class="bg-blue-100 px-1 py-0.5 rounded text-blue-900 font-mono">AHMAD FAUZI</code>).</li>
                                    <li><strong>Tanggal Lahir:</strong> Masukkan Tanggal (1-31), Bulan (1-12), dan Tahun (4 digit, contoh: <code class="bg-blue-100 px-1 py-0.5 rounded text-blue-900 font-mono">2009</code>).</li>
                                </ul>
                            </div>

                            {{-- SUBMIT BUTTON --}}
                            <div class="pt-2">
                                <button type="submit" 
                                        class="w-full py-4 px-6 bg-[#1E5BB8] hover:bg-[#1A4F9C] active:bg-[#153F7C] text-white font-black tracking-wider text-xs sm:text-sm rounded-xl shadow-lg shadow-blue-900/20 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>LIHAT HASIL SELEKSI</span>
                                </button>
                            </div>
                        </form>

                    </div>

                {{-- JIKA SUDAH CARI: TAMPILKAN HASIL KELULUSAN FULLSCREEN ALA SNBP/SNPMB --}}
                @else
                    
                    {{-- 🟩 HASIL LOLOS SELEKSI (PASSED - TEMA OCEAN BLUE & LIGHT CARD BODY) --}}
                    @if(isset($candidate) && $candidate->isPassed())
                        @php 
                            $waLink = ($candidate->organization_type === 'MPK') ? ($whatsappLinkMpk ?? '') : ($whatsappLinkOsis ?? ''); 
                        @endphp
                        
                        <div class="bg-white text-slate-800 rounded-3xl overflow-hidden shadow-2xl border border-slate-200/80 space-y-0 animate-fade-in">
                            
                            {{-- FULL-WIDTH HEADER BANNER OCEAN BLUE DAPODIK STYLE --}}
                            <div class="bg-gradient-to-r from-[#1E5BB8] via-[#1A4F9C] to-[#153F7C] p-4 sm:p-7 md:p-8 flex flex-row items-center justify-between gap-3 border-b border-blue-900/30 shadow-md relative overflow-hidden text-white">
                                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

                                <div class="space-y-1 z-10 min-w-0 flex-1">
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/15 border border-white/25 backdrop-blur-md text-[9px] sm:text-xs font-black tracking-wider text-sky-100 uppercase truncate">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping shrink-0"></span>
                                        <span>SELEKSI 2026/2027 • {{ strtoupper($candidate->organization_type) }}</span>
                                    </div>
                                    <h3 class="text-base sm:text-2xl md:text-3xl font-black text-white tracking-tight leading-tight drop-shadow-md">
                                        SELAMAT! ANDA DINYATAKAN LOLOS SELEKSI
                                    </h3>
                                </div>

                                {{-- Logo OSIS MPK --}}
                                <div class="flex items-center gap-3 z-10 shrink-0">
                                    <div class="w-12 h-12 sm:w-20 sm:h-20 rounded-full overflow-hidden border-2 border-white/90 bg-white p-0.5 shadow-xl shrink-0">
                                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                                    </div>
                                </div>
                            </div>

                            {{-- MAIN BODY CONTAINER (CLEAN LIGHT THEME) --}}
                            <div class="p-4 sm:p-8 md:p-10 space-y-5 sm:space-y-8 bg-slate-50/50">
                                
                                {{-- 2-COLUMN GRID DESKTOP / SINGLE COLUMN MOBILE --}}
                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-8 items-start">
                                    
                                    {{-- LEFT SIDE: CANDIDATE INFO --}}
                                    <div class="lg:col-span-7 space-y-4">
                                        
                                        {{-- Noreg & Candidate Name --}}
                                        <div class="border-b border-slate-200 pb-3.5 space-y-1">
                                            <p class="text-[10px] sm:text-xs font-mono font-black text-[#1E5BB8] tracking-wider uppercase">
                                                NO. REGISTRASI: {{ $candidate->registration_number }}
                                            </p>
                                            <h2 class="text-xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight uppercase leading-snug break-words">
                                                {{ $candidate->full_name }}
                                            </h2>
                                            <p class="text-xs sm:text-sm font-bold text-slate-600">
                                                CALON PENGURUS {{ strtoupper($candidate->organization_type) }} — {{ strtoupper($candidate->class_name) }}
                                            </p>
                                        </div>

                                        {{-- Details Grid Cards --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 sm:gap-4 text-xs">
                                            <div class="p-3.5 sm:p-4 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-1">
                                                <p class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Tempat, Tanggal Lahir</p>
                                                <p class="text-xs sm:text-sm font-extrabold text-slate-900">{{ $candidate->birth_place }}, {{ $candidate->birth_date->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="p-3.5 sm:p-4 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-1">
                                                <p class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Kelas & Satuan Organisasi</p>
                                                <p class="text-xs sm:text-sm font-extrabold text-slate-900">{{ $candidate->class_name }} ({{ $candidate->organization_type }})</p>
                                            </div>
                                        </div>

                                        {{-- Catatan Panitia (If present) --}}
                                        @if($candidate->notes)
                                            <div class="p-3.5 sm:p-4 rounded-2xl bg-blue-50/80 border border-blue-200/80 text-xs text-blue-950 space-y-1 shadow-sm">
                                                <span class="font-extrabold text-[#1E5BB8] uppercase tracking-wider text-[10px] block">Catatan Panitia Seleksi:</span>
                                                <p class="font-medium italic text-slate-800 text-xs">"{{ $candidate->notes }}"</p>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- RIGHT SIDE: WHATSAPP GROUP INVITATION & QR CODE BOX --}}
                                    <div class="lg:col-span-5 space-y-3.5 flex flex-col items-stretch">
                                        
                                        <div class="bg-white text-slate-900 p-4 sm:p-6 rounded-2xl shadow-md border border-slate-200/90 space-y-3.5">
                                            <div class="flex flex-col sm:flex-row items-center sm:items-start justify-between gap-3">
                                                <div class="space-y-1 text-center sm:text-left min-w-0 flex-1">
                                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-black uppercase tracking-wider border border-emerald-200">
                                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                        Grup WhatsApp Resmi
                                                    </div>
                                                    <h4 class="text-sm sm:text-base font-black text-slate-900 leading-snug">
                                                        Undangan Grup WhatsApp Calon Pengurus {{ $candidate->organization_type }}
                                                    </h4>
                                                    <p class="text-xs text-slate-600 leading-relaxed font-medium">
                                                        Selamat! Silakan segera bergabung ke grup WhatsApp resmi calon pengurus {{ $candidate->organization_type }} untuk koordinasi &amp; informasi orientasi.
                                                    </p>
                                                </div>

                                                {{-- Inline WhatsApp QR Code Graphic (Render Uploaded QR Image if Available) --}}
                                                @php
                                                    $waQr = ($candidate->organization_type === 'MPK') ? ($whatsappQrMpk ?? '') : ($whatsappQrOsis ?? '');
                                                @endphp
                                                @if(!empty($waQr) && file_exists(public_path($waQr)))
                                                    <div class="bg-white p-1.5 rounded-2xl border border-slate-200/90 shrink-0 flex flex-col items-center shadow-md mx-auto sm:mx-0">
                                                        <img src="{{ asset($waQr) }}" alt="QR Code WhatsApp" class="w-24 h-24 sm:w-28 sm:h-28 object-contain rounded-xl">
                                                        <span class="text-[8px] font-mono font-black text-emerald-700 mt-1 uppercase tracking-wider">WA GROUP QR</span>
                                                    </div>
                                                @else
                                                    <div class="bg-emerald-50 p-2.5 rounded-2xl border border-emerald-200 shrink-0 flex flex-col items-center shadow-inner mx-auto sm:mx-0">
                                                        <svg class="w-16 h-16 sm:w-20 sm:h-20 text-emerald-600" viewBox="0 0 100 100" fill="currentColor">
                                                            <rect x="0" y="0" width="100" height="100" fill="#ecfdf5" />
                                                            {{-- QR Pattern --}}
                                                            <path d="M10 10h25v25h-25zM15 15v15h15v-15zM20 20h5v5h-5z"/>
                                                            <path d="M65 10h25v25h-25zM70 15v15h15v-15zM75 20h5v5h-5z"/>
                                                            <path d="M10 65h25v25h-25zM15 70v15h15v-15zM20 75h5v5h-5z"/>
                                                            <path d="M40 10h5v5h-5zM50 10h10v5h-10zM40 20h10v5h-10zM55 20h10v5h-10zM45 30h5v10h-5zM60 30h5v5h-5zM80 40h10v5h-10zM10 45h10v5h-10zM30 45h5v5h-5zM45 45h10v5h-10zM65 45h5v10h-5zM80 50h10v5h-10zM35 55h10v5h-10zM50 55h5v5h-5zM75 60h15v5h-15zM40 65h10v5h-10zM55 65h5v10h-5zM70 65h10v5h-10zM45 75h10v5h-10zM65 75h5v5h-5zM80 75h10v5h-10zM40 85h5v5h-5zM55 85h15v5h-15zM80 85h5v5h-5z"/>
                                                        </svg>
                                                        <span class="text-[8px] font-mono font-black text-emerald-700 mt-1 uppercase tracking-wider">WA GROUP</span>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Join WhatsApp Group Button --}}
                                            <div class="pt-1">
                                                @if($waLink)
                                                    <a href="{{ $waLink }}" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer" 
                                                       class="w-full py-3.5 px-4 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] active:bg-[#1da850] text-white font-black text-xs sm:text-sm flex items-center justify-center gap-2.5 shadow-md shadow-emerald-600/20 transition duration-200">
                                                        <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24">
                                                            <path d="M12.031 0C5.384 0 0 5.383 0 12.031c0 2.124.553 4.197 1.604 6.02L.031 24l6.096-1.599a11.968 11.968 0 005.904 1.558h.005c6.645 0 12.028-5.383 12.028-12.028C24.064 5.383 18.681 0 12.031 0zm6.985 16.985c-.292.822-1.44 1.503-2.38 1.705-.644.137-1.485.247-4.316-.921-3.623-1.493-5.962-5.176-6.143-5.417-.18-.24-1.472-1.959-1.472-3.738 0-1.778.931-2.654 1.261-3.014.33-.36.72-.45.961-.45.24 0 .48.003.69.013.226.01.527-.086.826.63.3.72 1.02 2.49 1.11 2.67.09.18.15.39.03.63-.12.24-.18.39-.36.6-.18.21-.378.47-.54.63-.18.18-.368.375-.158.735.21.36.936 1.545 2.008 2.5 1.378 1.23 2.54 1.612 2.9 1.792.36.18.57.15.78-.09.21-.24.9-1.05 1.14-1.41.24-.36.48-.3.81-.18.33.12 2.1.99 2.46 1.17.36.18.6.27.69.42.09.15.09.87-.202 1.692z"/>
                                                        </svg>
                                                        <span>BERGABUNG KE GRUP WHATSAPP</span>
                                                    </a>
                                                @else
                                                    <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-900 font-semibold leading-relaxed flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span>Tautan Grup WhatsApp resmi akan diinformasikan lebih lanjut oleh panitia seleksi.</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Mobile Status View --}}
                                        <div class="sm:hidden flex items-center justify-between p-3 bg-white rounded-xl border border-slate-200 shadow-sm text-xs">
                                            <span class="text-slate-600 font-medium">Keabsahan Kelulusan:</span>
                                            <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-black border border-emerald-300">TERVERIFIKASI RESMI</span>
                                        </div>

                                    </div>

                                </div>

                                {{-- FOOTNOTE DISCLAIMER --}}
                                <div class="pt-4 border-t border-slate-200 text-[11px] sm:text-xs text-slate-500 leading-relaxed font-medium space-y-1">
                                    <p>
                                        Status penerimaan Anda sebagai calon pengurus akan ditetapkan secara sah setelah peserta mengikuti seluruh tahapan verifikasi fisik oleh panitia seleksi sekolah. Silakan ikuti arahan dari pembina &amp; panitia seleksi di grup WhatsApp.
                                    </p>
                                </div>

                                {{-- ACTION BUTTON BAR --}}
                                <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-200">
                                    <a href="{{ route('pengumuman.index') }}" 
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white hover:bg-slate-100 active:bg-slate-200 text-slate-800 font-extrabold text-xs sm:text-sm transition border border-slate-300 shadow-sm">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <span>Cek Nama Lain / Cari Ulang</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    {{-- 🟥 HASIL TIDAK LOLOS SELEKSI (FAILED - LIGHT CARD THEME) --}}
                    @elseif(isset($candidate) && $candidate->isFailed())
                        <div class="bg-white text-slate-800 rounded-3xl overflow-hidden shadow-2xl border border-slate-200/80 space-y-0 animate-fade-in">
                            
                            {{-- FULL-WIDTH HEADER BANNER MERAH --}}
                            <div class="bg-gradient-to-r from-rose-700 via-red-700 to-rose-800 p-5 sm:p-7 md:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border-b border-rose-900/30 shadow-md relative overflow-hidden text-white">
                                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

                                <div class="space-y-1.5 z-10">
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/25 backdrop-blur-md text-[10px] sm:text-xs font-black tracking-wider text-rose-100 uppercase">
                                        SELEKSI 2026/2027 • CALON PENGURUS {{ strtoupper($candidate->organization_type) }}
                                    </div>
                                    <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight drop-shadow-md">
                                        MOHON MAAF, ANDA DINYATAKAN TIDAK LOLOS SELEKSI
                                    </h3>
                                </div>

                                {{-- Logo Badge --}}
                                <div class="flex items-center gap-3 z-10 self-end md:self-auto shrink-0">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden border-2 border-white/90 bg-white p-0.5 shadow-xl shrink-0">
                                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                                    </div>
                                </div>
                            </div>

                            {{-- MAIN BODY CONTAINER (LIGHT THEME) --}}
                            <div class="p-5 sm:p-8 md:p-10 space-y-6 sm:space-y-8 bg-slate-50/50">
                                
                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                                    
                                    {{-- LEFT SIDE: CANDIDATE INFO --}}
                                    <div class="lg:col-span-7 space-y-5">
                                        <div class="border-b border-slate-200 pb-4 space-y-1">
                                            <p class="text-[11px] sm:text-xs font-mono font-black text-rose-600 tracking-wider uppercase">
                                                NO. REGISTRASI: {{ $candidate->registration_number }}
                                            </p>
                                            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight uppercase leading-snug">
                                                {{ $candidate->full_name }}
                                            </h2>
                                            <p class="text-xs sm:text-sm font-bold text-slate-600">
                                                CALON PENGURUS {{ strtoupper($candidate->organization_type) }} — {{ strtoupper($candidate->class_name) }}
                                            </p>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-xs">
                                            <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-1">
                                                <p class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Tempat, Tanggal Lahir</p>
                                                <p class="text-sm font-extrabold text-slate-900">{{ $candidate->birth_place }}, {{ $candidate->birth_date->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-1">
                                                <p class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Kelas & Satuan Organisasi</p>
                                                <p class="text-sm font-extrabold text-slate-900">{{ $candidate->class_name }} ({{ $candidate->organization_type }})</p>
                                            </div>
                                        </div>

                                        @if($candidate->notes)
                                            <div class="p-4 rounded-2xl bg-rose-50/80 border border-rose-200/80 text-xs text-rose-950 space-y-1 shadow-sm">
                                                <span class="font-extrabold text-rose-600 uppercase tracking-wider text-[10px] block">Catatan Panitia Seleksi:</span>
                                                <p class="font-medium italic text-slate-800">"{{ $candidate->notes }}"</p>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- RIGHT SIDE: MESSAGE BOX --}}
                                    <div class="lg:col-span-5 space-y-4 flex flex-col items-stretch">
                                        <div class="bg-white text-slate-900 p-5 sm:p-6 rounded-2xl shadow-lg border border-slate-200/90 space-y-3">
                                            <div class="space-y-2">
                                                <h4 class="text-sm sm:text-base font-black text-rose-600 leading-snug">
                                                    Pesan Semangat Panitia Seleksi
                                                </h4>
                                                <p class="text-xs text-slate-600 leading-relaxed font-medium">
                                                    Jangan berkecil hati. Perjuangan dan kesempatan berkarya serta berprestasi masih sangat luas di berbagai organisasi dan ekstrakurikuler sekolah lainnya.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="pt-4 border-t border-slate-200 text-[11px] sm:text-xs text-slate-500 leading-relaxed font-medium space-y-1">
                                    <p>
                                        Keputusan panitia seleksi bersifat final dan tidak dapat diganggu gugat. Terima kasih telah berpartisipasi aktif dalam proses seleksi calon pengurus.
                                    </p>
                                </div>

                                <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-200">
                                    <a href="{{ route('pengumuman.index') }}" 
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white hover:bg-slate-100 active:bg-slate-200 text-slate-800 font-extrabold text-xs sm:text-sm transition border border-slate-300 shadow-sm">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <span>Cek Nama Lain / Cari Ulang</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    {{-- 🟧 HASIL PROSES SELEKSI (PENDING - LIGHT CARD THEME) --}}
                    @elseif(isset($candidate) && $candidate->isPending())
                        <div class="bg-white text-slate-800 rounded-3xl overflow-hidden shadow-2xl border border-slate-200/80 space-y-0 animate-fade-in">
                            
                            {{-- FULL-WIDTH HEADER BANNER ORANYE --}}
                            <div class="bg-gradient-to-r from-amber-600 via-orange-600 to-amber-700 p-5 sm:p-7 md:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border-b border-amber-900/30 shadow-md relative overflow-hidden text-white">
                                <div class="space-y-1.5 z-10">
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/25 backdrop-blur-md text-[10px] sm:text-xs font-black tracking-wider text-amber-100 uppercase">
                                        SELEKSI 2026/2027 • CALON PENGURUS {{ strtoupper($candidate->organization_type) }}
                                    </div>
                                    <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight drop-shadow-md">
                                        STATUS SELEKSI DALAM PROSES PENILAIAN
                                    </h3>
                                </div>

                                {{-- Logo Badge --}}
                                <div class="flex items-center gap-3 z-10 self-end md:self-auto shrink-0">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden border-2 border-white/90 bg-white p-0.5 shadow-xl shrink-0">
                                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                                    </div>
                                </div>
                            </div>

                            {{-- MAIN BODY CONTAINER --}}
                            <div class="p-5 sm:p-8 md:p-10 space-y-6 sm:space-y-8 bg-slate-50/50">
                                
                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                                    <div class="lg:col-span-7 space-y-5">
                                        <div class="border-b border-slate-200 pb-4 space-y-1">
                                            <p class="text-[11px] sm:text-xs font-mono font-black text-amber-600 tracking-wider uppercase">
                                                NO. REGISTRASI: {{ $candidate->registration_number }}
                                            </p>
                                            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight uppercase leading-snug">
                                                {{ $candidate->full_name }}
                                            </h2>
                                            <p class="text-xs sm:text-sm font-bold text-slate-600">
                                                CALON PENGURUS {{ strtoupper($candidate->organization_type) }} — {{ strtoupper($candidate->class_name) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="lg:col-span-5">
                                        <div class="bg-white text-slate-900 p-5 sm:p-6 rounded-2xl shadow-lg border border-slate-200/90 space-y-2">
                                            <h4 class="text-sm font-black text-amber-600">Informasi Tahap Evaluasi</h4>
                                            <p class="text-xs text-slate-600 leading-relaxed font-medium">
                                                Berkas pendaftaran dan hasil wawancara Anda saat ini sedang dalam tahap rapat plenari panitia seleksi. Silakan periksa kembali halaman ini secara berkala.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-200">
                                    <a href="{{ route('pengumuman.index') }}" 
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white hover:bg-slate-100 active:bg-slate-200 text-slate-800 font-extrabold text-xs sm:text-sm transition border border-slate-300 shadow-sm">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <span>Cek Nama Lain / Cari Ulang</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    {{-- DATA TIDAK DITEMUKAN --}}
                    @else
                        <div class="p-6 sm:p-10 rounded-3xl bg-white border border-rose-200 text-rose-950 space-y-6 shadow-xl text-center animate-fade-in max-w-2xl mx-auto">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden border-2 border-rose-300 p-0.5 bg-white shadow-md mx-auto">
                                <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div class="space-y-2">
                                <h4 class="text-xl sm:text-2xl font-black text-slate-900">Data Calon Tidak Ditemukan</h4>
                                <p class="text-xs sm:text-sm text-slate-600 font-medium max-w-md mx-auto leading-relaxed">
                                    Maaf, data pencarian untuk <strong class="text-slate-900">"{{ $searchName }}"</strong> dengan tanggal lahir <strong class="text-slate-900">{{ \Carbon\Carbon::parse($searchDate)->format('d/m/Y') }}</strong> tidak ditemukan dalam sistem.
                                </p>
                            </div>
                            
                            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-100 text-xs text-rose-800 font-medium flex items-center justify-center gap-2 text-left">
                                <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                                <div>
                                    <strong class="font-bold text-rose-900">Saran Pencarian:</strong> Pastikan ejaan Nama Lengkap dan Tanggal Lahir yang Anda masukkan sudah persis sama dengan data pendaftaran awal.
                                </div>
                            </div>

                            {{-- BUTTON CEK NAMA LAIN --}}
                            <div class="pt-2 flex justify-center">
                                <a href="{{ route('pengumuman.index') }}" 
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#1E5BB8] hover:bg-[#1A4F9C] active:bg-[#153F7C] text-white font-extrabold text-xs sm:text-sm transition shadow-lg shadow-blue-900/20">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Cek Nama Lain / Cari Ulang</span>
                                </a>
                            </div>
                        </div>
                    @endif

                @endif

            @endif

        </main>

        {{-- FOOTER --}}
        <footer class="bg-white border-t border-slate-200 py-8 sm:py-10 px-6 text-center text-xs text-slate-500 font-medium space-y-3 mt-auto">
            <div class="flex items-center justify-center gap-2">
                <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-6 h-6 rounded-full object-cover border border-slate-200">
                <span class="font-black text-slate-800">GAMANANTHA ANVAYA</span>
            </div>
            <p>&copy; {{ date('Y') }} Panitia Seleksi OSIS & MPK GAMANANTHA ANVAYA. All Rights Reserved.</p>
        </footer>

    </body>
</html>
