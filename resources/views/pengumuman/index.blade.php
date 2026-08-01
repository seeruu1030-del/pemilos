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
        
        {{-- Fonts: Inter & Plus Jakarta Sans --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', 'Plus Jakarta Sans', sans-serif;
            }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="min-h-screen font-sans antialiased text-slate-800 bg-[#F4F7FC] flex flex-col justify-between selection:bg-blue-600 selection:text-white">
        
        {{-- HERO BACKGROUND BANNER --}}
        <header class="relative bg-gradient-to-r from-[#1E5BB8] via-[#1A4F9C] to-[#153F7C] text-white pt-10 sm:pt-12 pb-24 sm:pb-28 px-4 sm:px-6 lg:px-8 overflow-hidden shadow-md">
            {{-- Grid Line Overlay Pattern --}}
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:24px_24px]"></div>
            
            <div class="max-w-4xl mx-auto relative z-10 text-center space-y-3 sm:space-y-4">
                {{-- Official Badge Pill --}}
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-sky-200 text-[11px] sm:text-xs font-black border border-white/20 shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Portal Resmi Pengumuman Seleksi OSIS & MPK 2026/2027
                </div>

                {{-- Hero Headline --}}
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                    Pengumuman Hasil Seleksi OSIS & MPK
                </h1>

                <p class="text-xs sm:text-base text-sky-100 font-medium max-w-xl mx-auto leading-relaxed">
                    Masukkan nama lengkap dan tanggal lahir calon peserta untuk melihat hasil keputusan kelulusan seleksi.
                </p>
                
                {{-- Back Link to Homepage --}}
                <div class="pt-1 sm:pt-2">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-xs font-extrabold text-white transition shadow-sm">
                        <svg class="w-4 h-4 text-sky-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali ke Beranda Utama</span>
                    </a>
                </div>
            </div>
        </header>

        {{-- MAIN FLOATING CONTENT AREA --}}
        <main class="relative z-20 max-w-2xl mx-auto px-4 -mt-16 sm:-mt-20 mb-12 sm:mb-16 w-full space-y-6">

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

                    <div class="p-4 sm:p-5 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 font-semibold leading-relaxed shadow-inner">
                        📢 <strong>Informasi Panitia:</strong><br>
                        Proses rekrutmen sedang berlangsung. Kembali lagi nanti saat pengumuman penerimaan kelulusan diinformasikan lagi oleh panitia sekolah.
                    </div>
                </div>

            {{-- CASE 2: HITUNGAN MUNDUR (COUNTDOWN TIMER) --}}
            @elseif($mode === 'countdown')

                <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-10 shadow-xl space-y-6 sm:space-y-8 text-center animate-fade-in"
                     x-data="{
                         target: new Date('{{ $targetTimestamp }}').getTime(),
                         days: 0,
                         hours: 0,
                         minutes: 0,
                         seconds: 0,
                         expired: false,
                         updateTimer() {
                             const now = new Date().getTime();
                             const distance = this.target - now;
                             if (distance < 0) {
                                 this.expired = true;
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
                            <div class="pt-2">
                                <span class="inline-block px-4 py-2 rounded-xl bg-blue-50 border border-blue-200 text-xs font-black text-[#1E5BB8]">
                                    🗓 {{ \Carbon\Carbon::parse($datetime)->translatedFormat('l, d F Y - H:i') }} WIB
                                </span>
                            </div>
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

                    <div class="p-3.5 rounded-xl bg-slate-100 border border-slate-200 text-[11px] text-slate-600 font-medium">
                        ⏳ Halaman ini akan memperbarui secara otomatis saat hitungan mundur selesai.
                    </div>
                </div>

            {{-- CASE 3: PENGUMUMAN DIBUKA (HASIL SELEKSI ATAU FORM CEK HASIL) --}}
            @else

                {{-- JIKA BELUM CARI (ATAU SUDAH KLIK CEK NAMA LAIN): TAMPILKAN FORM CEK HASIL --}}
                @if(!isset($searched))

                    <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-10 shadow-xl space-y-6 sm:space-y-8 animate-fade-in">
                        
                        {{-- Card Title Branding --}}
                        <div class="text-center space-y-3 border-b border-slate-100 pb-5">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden border-2 border-blue-600 p-0.5 bg-white shadow-md mx-auto">
                                <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div class="space-y-1">
                                <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight uppercase">
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
                                    Tanggal Lahir *
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
                                               placeholder="Tanggal" 
                                               class="w-full py-3.5 px-2.5 sm:px-3 bg-slate-50 border border-slate-300 rounded-xl text-center font-bold text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:outline-none transition" />
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
                                               placeholder="Bulan" 
                                               class="w-full py-3.5 px-2.5 sm:px-3 bg-slate-50 border border-slate-300 rounded-xl text-center font-bold text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:outline-none transition" />
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
                                               placeholder="Tahun" 
                                               class="w-full py-3.5 px-2.5 sm:px-3 bg-slate-50 border border-slate-300 rounded-xl text-center font-bold text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:outline-none transition" />
                                    </div>
                                </div>
                                @error('birth_date')
                                    <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- PANDUAN PENGISIAN --}}
                            <div class="p-3.5 sm:p-4 rounded-2xl bg-blue-50 border border-blue-200 text-xs text-blue-950 space-y-1.5 font-medium">
                                <p class="font-extrabold text-[#1E5BB8] flex items-center gap-1.5">
                                    <span>📌</span> <span>Panduan Pengisian:</span>
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

                {{-- JIKA SUDAH CARI: SEBAGAI GANTINYA TAMPILKAN CARD HASIL KELULUSAN SECARA EKSKLUSIF --}}
                @else
                    
                    {{-- 🟩 HASIL LOLOS SELEKSI (PASSED - HIJAU) --}}
                    @if(isset($candidate) && $candidate->isPassed())
                        <div class="bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800 text-white rounded-3xl p-5 sm:p-10 shadow-xl border border-emerald-500 space-y-6 animate-fade-in">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-emerald-500/50 pb-5 sm:pb-6">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden border-2 border-white/80 bg-white p-0.5 shadow-lg shrink-0">
                                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                                    </div>
                                    <div class="space-y-1">
                                        <span class="inline-block px-3.5 py-1 rounded-full bg-emerald-500/30 border border-emerald-400 text-emerald-100 text-[10px] sm:text-xs font-black tracking-widest uppercase">
                                            PENGUMUMAN KELULUSAN 2026 / 2027
                                        </span>
                                        <h3 class="text-xl sm:text-3xl font-black text-white tracking-tight">
                                            SELAMAT! ANDA DINYATAKAN LOLOS SELEKSI
                                        </h3>
                                        <p class="text-emerald-100 text-xs font-semibold">
                                            CALON PENGURUS {{ $candidate->organization_type }} PERIODE 2026/2027
                                        </p>
                                    </div>
                                </div>

                                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center shrink-0 border border-white/30 text-white text-2xl sm:text-3xl font-black shadow-lg self-end sm:self-center">
                                    ✓
                                </div>
                            </div>

                            {{-- Candidate Details --}}
                            <div class="bg-emerald-950/40 rounded-2xl p-4 sm:p-5 border border-emerald-500/40 backdrop-blur-md grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-xs">
                                <div>
                                    <p class="text-emerald-300 font-bold uppercase tracking-wider text-[10px]">Nomor Registrasi</p>
                                    <p class="text-sm sm:text-base font-mono font-black text-white">{{ $candidate->registration_number }}</p>
                                </div>
                                <div>
                                    <p class="text-emerald-300 font-bold uppercase tracking-wider text-[10px]">Nama Lengkap Calon</p>
                                    <p class="text-sm sm:text-base font-black text-white">{{ $candidate->full_name }}</p>
                                </div>
                                <div>
                                    <p class="text-emerald-300 font-bold uppercase tracking-wider text-[10px]">Tempat, Tgl Lahir</p>
                                    <p class="text-xs sm:text-sm font-bold text-white">{{ $candidate->birth_place }}, {{ $candidate->birth_date->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-emerald-300 font-bold uppercase tracking-wider text-[10px]">Kelas & Organisasi</p>
                                    <p class="text-xs sm:text-sm font-bold text-white">{{ $candidate->class_name }} ({{ $candidate->organization_type }})</p>
                                </div>
                            </div>

                            @if($candidate->notes)
                                <div class="p-4 rounded-xl bg-emerald-950/30 border border-emerald-500/30 text-xs text-emerald-100 font-medium">
                                    <strong>Catatan Panitia:</strong> "{{ $candidate->notes }}"
                                </div>
                            @endif

                            <div class="p-4 rounded-xl bg-white/10 border border-white/20 text-xs text-emerald-100 leading-relaxed font-medium">
                                📌 <strong>Instruksi Selanjutnya:</strong> Silakan melakukan verifikasi berkas ulang dan mengikuti Orientasi Calon Pengurus {{ $candidate->organization_type }} pada jadwal yang ditentukan panitia.
                            </div>

                            {{-- BUTTON CEK NAMA LAIN --}}
                            <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-emerald-500/40">
                                <a href="{{ route('pengumuman.index') }}" 
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/20 hover:bg-white/30 active:bg-white/40 backdrop-blur-md text-white font-extrabold text-xs transition border border-white/30 shadow-md">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Cek Nama Lain / Cari Ulang</span>
                                </a>
                            </div>
                        </div>

                    {{-- 🟥 HASIL TIDAK LOLOS SELEKSI (FAILED - MERAH) --}}
                    @elseif(isset($candidate) && $candidate->isFailed())
                        <div class="bg-gradient-to-br from-rose-600 via-rose-700 to-red-800 text-white rounded-3xl p-5 sm:p-10 shadow-xl border border-rose-500 space-y-6 animate-fade-in">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-rose-500/50 pb-5 sm:pb-6">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden border-2 border-white/80 bg-white p-0.5 shadow-lg shrink-0">
                                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                                    </div>
                                    <div class="space-y-1">
                                        <span class="inline-block px-3.5 py-1 rounded-full bg-rose-500/30 border border-rose-400 text-rose-100 text-[10px] sm:text-xs font-black tracking-widest uppercase">
                                            PENGUMUMAN KELULUSAN 2026 / 2027
                                        </span>
                                        <h3 class="text-xl sm:text-3xl font-black text-white tracking-tight">
                                            MOHON MAAF, ANDA DINYATAKAN TIDAK LOLOS SELEKSI
                                        </h3>
                                        <p class="text-rose-100 text-xs font-semibold">
                                            CALON PENGURUS {{ $candidate->organization_type }} PERIODE 2026/2027
                                        </p>
                                    </div>
                                </div>

                                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center shrink-0 border border-white/30 text-white text-2xl sm:text-3xl font-black shadow-lg self-end sm:self-center">
                                    ✕
                                </div>
                            </div>

                            {{-- Candidate Details --}}
                            <div class="bg-rose-950/40 rounded-2xl p-4 sm:p-5 border border-rose-500/40 backdrop-blur-md grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-xs">
                                <div>
                                    <p class="text-rose-300 font-bold uppercase tracking-wider text-[10px]">Nomor Registrasi</p>
                                    <p class="text-sm sm:text-base font-mono font-black text-white">{{ $candidate->registration_number }}</p>
                                </div>
                                <div>
                                    <p class="text-rose-300 font-bold uppercase tracking-wider text-[10px]">Nama Lengkap Calon</p>
                                    <p class="text-sm sm:text-base font-black text-white">{{ $candidate->full_name }}</p>
                                </div>
                                <div>
                                    <p class="text-rose-300 font-bold uppercase tracking-wider text-[10px]">Tempat, Tgl Lahir</p>
                                    <p class="text-xs sm:text-sm font-bold text-white">{{ $candidate->birth_place }}, {{ $candidate->birth_date->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-rose-300 font-bold uppercase tracking-wider text-[10px]">Kelas & Organisasi</p>
                                    <p class="text-xs sm:text-sm font-bold text-white">{{ $candidate->class_name }} ({{ $candidate->organization_type }})</p>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-white/10 border border-white/20 text-xs text-rose-100 leading-relaxed font-medium">
                                💪 <strong>Pesan Panitia:</strong> Jangan berkecil hati. Perjuangan dan kesempatan berkarya serta berprestasi masih sangat luas di berbagai ekstrakurikuler sekolah.
                            </div>

                            {{-- BUTTON CEK NAMA LAIN --}}
                            <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-rose-500/40">
                                <a href="{{ route('pengumuman.index') }}" 
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/20 hover:bg-white/30 active:bg-white/40 backdrop-blur-md text-white font-extrabold text-xs transition border border-white/30 shadow-md">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Cek Nama Lain / Cari Ulang</span>
                                </a>
                            </div>
                        </div>

                    {{-- 🟧 HASIL PROSES SELEKSI (PENDING - ORANYE) --}}
                    @elseif(isset($candidate) && $candidate->isPending())
                        <div class="bg-gradient-to-br from-amber-500 via-amber-600 to-orange-700 text-white rounded-3xl p-5 sm:p-10 shadow-xl border border-amber-400 space-y-6 animate-fade-in">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-amber-400/50 pb-5 sm:pb-6">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden border-2 border-white/80 bg-white p-0.5 shadow-lg shrink-0">
                                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                                    </div>
                                    <div class="space-y-1">
                                        <span class="inline-block px-3.5 py-1 rounded-full bg-amber-400/30 border border-amber-300 text-amber-100 text-[10px] sm:text-xs font-black tracking-widest uppercase">
                                            PENGUMUMAN KELULUSAN 2026 / 2027
                                        </span>
                                        <h3 class="text-xl sm:text-3xl font-black text-white tracking-tight">
                                            STATUS SELEKSI DALAM PROSES PENILAIAN
                                        </h3>
                                        <p class="text-amber-100 text-xs font-semibold">
                                            CALON PENGURUS {{ $candidate->organization_type }} PERIODE 2026/2027
                                        </p>
                                    </div>
                                </div>

                                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center shrink-0 border border-white/30 text-white text-2xl font-black shadow-lg self-end sm:self-center">
                                    ⏳
                                </div>
                            </div>

                            {{-- Candidate Details --}}
                            <div class="bg-amber-950/40 rounded-2xl p-4 sm:p-5 border border-amber-400/40 backdrop-blur-md grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-xs">
                                <div>
                                    <p class="text-amber-200 font-bold uppercase tracking-wider text-[10px]">Nomor Registrasi</p>
                                    <p class="text-sm sm:text-base font-mono font-black text-white">{{ $candidate->registration_number }}</p>
                                </div>
                                <div>
                                    <p class="text-amber-200 font-bold uppercase tracking-wider text-[10px]">Nama Lengkap Calon</p>
                                    <p class="text-sm sm:text-base font-black text-white">{{ $candidate->full_name }}</p>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-white/10 border border-white/20 text-xs text-amber-100 leading-relaxed font-medium">
                                📢 <strong>Informasi:</strong> Berkas pendaftaran dan wawancara Anda saat ini sedang dalam tahap verifikasi akhir panitia seleksi. Silakan cek secara berkala.
                            </div>

                            {{-- BUTTON CEK NAMA LAIN --}}
                            <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-amber-400/40">
                                <a href="{{ route('pengumuman.index') }}" 
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/20 hover:bg-white/30 active:bg-white/40 backdrop-blur-md text-white font-extrabold text-xs transition border border-white/30 shadow-md">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Cek Nama Lain / Cari Ulang</span>
                                </a>
                            </div>
                        </div>

                    {{-- ⚠️ DATA TIDAK DITEMUKAN --}}
                    @else
                        <div class="p-5 sm:p-8 rounded-3xl bg-white border border-rose-200 text-rose-950 space-y-5 shadow-xl text-center animate-fade-in">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden border-2 border-rose-300 p-0.5 bg-white shadow-md mx-auto">
                                <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div class="space-y-1.5">
                                <h4 class="text-lg sm:text-xl font-black text-slate-900">Data Calon Tidak Ditemukan</h4>
                                <p class="text-xs sm:text-sm text-slate-600 font-medium max-w-md mx-auto leading-relaxed">
                                    Maaf, data pencarian untuk <strong>"{{ $searchName }}"</strong> dengan tanggal lahir <strong>{{ \Carbon\Carbon::parse($searchDate)->format('d/m/Y') }}</strong> tidak ditemukan dalam sistem.
                                </p>
                            </div>
                            
                            <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-100 text-[11px] sm:text-xs text-rose-800 font-medium">
                                💡 <strong>Saran:</strong> Pastikan penulisan ejaan Nama Lengkap dan Tanggal Lahir sudah sesuai dengan data saat pendaftaran.
                            </div>

                            {{-- BUTTON CEK NAMA LAIN --}}
                            <div class="pt-2 flex justify-center">
                                <a href="{{ route('pengumuman.index') }}" 
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#1E5BB8] hover:bg-[#1A4F9C] active:bg-[#153F7C] text-white font-extrabold text-xs transition shadow-lg shadow-blue-900/20">
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
