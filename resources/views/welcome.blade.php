<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth bg-[#F4F7FC]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="index, follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Portal Resmi Penerimaan & Pengumuman Seleksi OSIS & MPK SMKS Nurul Islam Cianjur Periode 2026/2027">
        
        <title>Portal Resmi Penerimaan OSIS & MPK | SMKS Nurul Islam</title>
        
        {{-- Fonts: Outfit & Urbanist --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Urbanist:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Outfit', 'Urbanist', sans-serif;
            }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="min-h-full font-sans antialiased text-slate-800 bg-[#F4F7FC] flex flex-col justify-between selection:bg-blue-600 selection:text-white" x-data="{ mobileMenu: false }">
        
        {{-- HEADER NAVBAR --}}
        <header class="sticky top-0 z-50 bg-gradient-to-r from-[#1E5BB8] via-[#1A4F9C] to-[#153F7C] text-white border-b border-blue-900/40 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                
                {{-- Logo & Brand --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white/30 p-0.5 bg-white shadow-lg group-hover:scale-105 transition-transform">
                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                    </div>
                    <div>
                        <h1 class="text-base font-black tracking-wider text-white leading-none">GAMANANTHA ANVAYA</h1>
                        <p class="text-[11px] font-bold text-sky-200 mt-0.5">OSKA 2026/2027</p>
                    </div>
                </a>

                {{-- Desktop Navigation Menu --}}
                <nav class="hidden md:flex items-center gap-6 text-xs font-extrabold text-sky-100">
                    <a href="#beranda" class="hover:text-white transition">Beranda</a>
                    <a href="#informasi" class="hover:text-white transition">Informasi Pendaftaran</a>
                    <a href="#jadwal" class="hover:text-white transition">Jadwal Seleksi</a>
                    <a href="{{ route('pengumuman.index') }}" class="hover:text-white transition px-4 py-2 rounded-full bg-white/10 border border-white/20">Cek Hasil Kelulusan ➔</a>
                </nav>

                {{-- Admin Login Button --}}
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('login') }}" 
                       class="px-5 py-2.5 bg-white text-[#1E5BB8] hover:bg-sky-50 font-black text-xs rounded-xl shadow-lg shadow-blue-900/30 hover:shadow-white/20 transition flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#1E5BB8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Masuk Sistem</span>
                    </a>
                </div>

                {{-- Mobile Hamburger Toggle --}}
                <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 rounded-xl text-sky-100 hover:bg-white/10" aria-label="Menu Navigasi Mobile">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            {{-- Mobile Menu Dropdown --}}
            <div x-show="mobileMenu" @click.away="mobileMenu = false" x-cloak class="md:hidden bg-[#153F7C] border-t border-blue-800 p-4 space-y-3 text-xs font-extrabold text-white">
                <a href="#beranda" @click="mobileMenu = false" class="block py-2">Beranda</a>
                <a href="#informasi" @click="mobileMenu = false" class="block py-2">Informasi Pendaftaran</a>
                <a href="#jadwal" @click="mobileMenu = false" class="block py-2">Jadwal Seleksi</a>
                <a href="{{ route('pengumuman.index') }}" class="block py-2 text-sky-300">Cek Hasil Kelulusan ➔</a>
                <a href="{{ route('login') }}" class="block py-3 px-4 bg-white text-[#1E5BB8] font-black rounded-xl text-center shadow-md">Masuk Sistem / Login Admin</a>
            </div>
        </header>

        {{-- HERO SECTION --}}
        <section id="beranda" class="relative bg-gradient-to-r from-[#1E5BB8] via-[#1A4F9C] to-[#153F7C] text-white py-16 sm:py-24 px-4 sm:px-6 lg:px-8 overflow-hidden">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:24px_24px]"></div>
            
            <div class="max-w-5xl mx-auto relative z-10 text-center space-y-6">
                
                {{-- Official Badge Pill --}}
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-sky-200 text-xs font-black border border-white/20 shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Portal Resmi Penerimaan & Pengumuman Seleksi OSIS-MPK 2026/2027
                </div>

                {{-- Hero Headline --}}
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight max-w-4xl mx-auto">
                    Penerimaan & Pengumuman Seleksi Calon Pengurus OSIS & MPK
                </h1>

                {{-- Hero Subtitle --}}
                <p class="text-sm sm:text-lg text-sky-100 font-medium max-w-2xl mx-auto leading-relaxed">
                    Selamat datang di Portal Resmi SMKS Nurul Islam. Akses informasi pendaftaran calon pengurus OSIS & MPK, alur seleksi, serta cek hasil pengumuman kelulusan online.
                </p>

                {{-- CTA Buttons --}}
                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('pengumuman.index') }}" 
                       class="w-full sm:w-auto px-8 py-4 bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-black text-sm rounded-2xl shadow-xl shadow-emerald-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Cek Hasil Kelulusan ➔</span>
                    </a>

                    <a href="#informasi" 
                       class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-black text-sm rounded-2xl border border-white/30 transition flex items-center justify-center gap-2">
                        <span>Informasi Pendaftaran</span>
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                </div>

            </div>
        </section>

        {{-- MAIN CONTENT AREA --}}
        <main class="py-16 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto space-y-20">

            {{-- SECTION 1: INFORMASI PENDAFTARAN OSIS & MPK --}}
            <section id="informasi" class="scroll-mt-28 space-y-8">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-blue-900 text-xs font-black border border-blue-200">
                        Informasi Pendaftaran
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Kriteria Calon Pengurus</h2>
                    <p class="text-xs text-slate-500 font-medium">Pilihan organisasi kepemimpinan siswa di SMKS Nurul Islam Periode 2026/2027</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    {{-- Card OSIS --}}
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-sm hover:shadow-md transition space-y-6 flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="px-3.5 py-1.5 rounded-full bg-blue-100 text-blue-900 font-black text-xs">
                                    OSIS (Organisasi Siswa Intra Sekolah)
                                </span>
                                <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-xl font-black text-slate-900">Kepemimpinan & Eksekusi Program Sekolah</h3>
                            <p class="text-xs text-slate-600 leading-relaxed font-medium">
                                OSIS merupakan wadah utama eksekutif siswa di SMKS Nurul Islam yang mengelola berbagai kegiatan pembinaan karakter, kedisiplinan, akademik, serta keolahragaan dan kesenian.
                            </p>
                            <ul class="space-y-2 text-xs text-slate-700 font-semibold pt-2">
                                <li class="flex items-center gap-2"><span class="text-blue-600 font-black">✓</span> Memiliki jiwa kepemimpinan & loyalitas tinggi</li>
                                <li class="flex items-center gap-2"><span class="text-blue-600 font-black">✓</span> Nilai akademis & sikap siswa yang baik</li>
                                <li class="flex items-center gap-2"><span class="text-blue-600 font-black">✓</span> Siap menjadi pelopor kedisiplinan di sekolah</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Card MPK --}}
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-sm hover:shadow-md transition space-y-6 flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="px-3.5 py-1.5 rounded-full bg-purple-100 text-purple-900 font-black text-xs">
                                    MPK (Majelis Perwakilan Kelas)
                                </span>
                                <div class="w-10 h-10 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-xl font-black text-slate-900">Legislatif & Pengawasan Aspirasi Siswa</h3>
                            <p class="text-xs text-slate-600 leading-relaxed font-medium">
                                MPK adalah badan perwakilan legislatif siswa yang bertugas mengawasi kinerja pengurus OSIS, menyerap aspirasi siswa dari seluruh kelas, serta menyusun aturan tata tertib internal siswa.
                            </p>
                            <ul class="space-y-2 text-xs text-slate-700 font-semibold pt-2">
                                <li class="flex items-center gap-2"><span class="text-purple-600 font-black">✓</span> Kritis, objektif, dan Mampu berkomunikasi efektif</li>
                                <li class="flex items-center gap-2"><span class="text-purple-600 font-black">✓</span> Mewakili aspirasi kelas dengan amanah</li>
                                <li class="flex items-center gap-2"><span class="text-purple-600 font-black">✓</span> Mampu mengevaluasi program kerja organisasi</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </section>

            {{-- SECTION 2: JADWAL TAHAPAN SELEKSI TIMELINE --}}
            <section id="jadwal" class="scroll-mt-28 space-y-8">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-blue-900 text-xs font-black border border-blue-200">
                        Jadwal Kegiatan
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Tahapan Seleksi 2026/2027</h2>
                    <p class="text-xs text-slate-500 font-medium">Timeline pelaksanaan pendaftaran hingga pengumuman akhir</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    {{-- Step 1 --}}
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-3 relative">
                        <span class="w-8 h-8 rounded-xl bg-blue-600 text-white font-black text-xs flex items-center justify-center shadow-md">1</span>
                        <h4 class="text-sm font-black text-slate-900">Pendaftaran Online & Berkas</h4>
                        <p class="text-xs text-slate-500 font-medium">01 - 15 Agustus 2026</p>
                        <p class="text-[11px] text-slate-600 leading-relaxed font-normal pt-1">Pengisian formulir pendaftaran calon pengurus OSIS & MPK oleh admin panitia.</p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-3 relative">
                        <span class="w-8 h-8 rounded-xl bg-blue-600 text-white font-black text-xs flex items-center justify-center shadow-md">2</span>
                        <h4 class="text-sm font-black text-slate-900">Seleksi Berkas & Administrasi</h4>
                        <p class="text-xs text-slate-500 font-medium">16 - 17 Agustus 2026</p>
                        <p class="text-[11px] text-slate-600 leading-relaxed font-normal pt-1">Pemeriksaan kelengkapan administrasi dan penilaian rekam jejak siswa.</p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-3 relative">
                        <span class="w-8 h-8 rounded-xl bg-blue-600 text-white font-black text-xs flex items-center justify-center shadow-md">3</span>
                        <h4 class="text-sm font-black text-slate-900">Wawancara & Uji Kelayakan</h4>
                        <p class="text-xs text-slate-500 font-medium">18 - 20 Agustus 2026</p>
                        <p class="text-[11px] text-slate-600 leading-relaxed font-normal pt-1">Wawancara tatap muka dengan pembina OSIS dan pengurus senior.</p>
                    </div>

                    {{-- Step 4 --}}
                    <div class="p-6 rounded-2xl bg-emerald-50 border border-emerald-200 shadow-sm space-y-3 relative">
                        <span class="w-8 h-8 rounded-xl bg-emerald-600 text-white font-black text-xs flex items-center justify-center shadow-md">4</span>
                        <h4 class="text-sm font-black text-emerald-950">Pengumuman Hasil Kelulusan</h4>
                        <p class="text-xs text-emerald-700 font-bold">25 Agustus 2026</p>
                        <p class="text-[11px] text-emerald-800 leading-relaxed font-medium pt-1">Cek hasil pengumuman akhir secara publik pada halaman pengumuman khusus.</p>
                    </div>

                </div>
            </section>

        </main>

        {{-- FOOTER --}}
        <footer class="bg-white border-t border-slate-200 py-10 px-6 mt-16 text-center text-xs text-slate-500 font-medium space-y-3">
            <div class="flex items-center justify-center gap-2">
                <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-6 h-6 rounded-full object-cover border border-slate-200">
                <span class="font-black text-slate-800">GAMANANTHA ANVAYA</span>
            </div>
            <p>&copy; {{ date('Y') }} Panitia Seleksi OSIS & MPK GAMANANTHA ANVAYA. All Rights Reserved.</p>
        </footer>

    </body>
</html>
