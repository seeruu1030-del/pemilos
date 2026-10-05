<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth bg-[#F4F7FC]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Pengumuman | SMKS Nurul Islam</title>
        
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
    <body class="min-h-full font-sans antialiased text-slate-800 bg-[#F4F7FC] flex flex-col justify-between selection:bg-blue-600 selection:text-white">
        
        {{-- HEADER NAVBAR --}}
        <header class="sticky top-0 z-50 bg-gradient-to-r from-[#1E5BB8] via-[#1A4F9C] to-[#153F7C] text-white border-b border-blue-900/40 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                
                {{-- Logo & Brand --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white/30 p-0.5 bg-white shadow-lg">
                        <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-full h-full object-cover rounded-full">
                    </div>
                    <div>
                        <h1 class="text-base font-black tracking-wider text-white leading-none">GAMANANTHA ANVAYA</h1>
                        <p class="text-[11px] font-bold text-sky-200 mt-0.5">OSKA 2026/2027</p>
                    </div>
                </div>

            </div>
        </header>

        {{-- HERO ANNOUNCEMENT BANNER --}}
        <section class="relative bg-gradient-to-r from-[#1E5BB8] via-[#1A4F9C] to-[#153F7C] text-white py-14 sm:py-18 px-4 sm:px-6 lg:px-8 overflow-hidden text-center">
            <div class="max-w-4xl mx-auto space-y-4">
                <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 text-sky-200 text-xs font-black border border-white/20">
                    Pengumuman Resmi
                </span>
                <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight">
                    Website Tidak Dapat Digunakan Sementara
                </h1>
                <p class="text-sm sm:text-base text-sky-100 font-medium max-w-2xl mx-auto leading-relaxed">
                    Pemberitahuan kepada seluruh pengguna bahwa sistem portal website saat ini sedang tidak dapat diakses dalam jangka waktu yang ditentukan.
                </p>
            </div>
        </section>

        {{-- MAIN CONTENT AREA --}}
        <main class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto flex-grow w-full">
            
            <div class="bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-12 shadow-sm space-y-8 text-center">
                
                <div class="space-y-3">
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900">
                        Pemberitahuan Nonaktif Sistem
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl mx-auto font-medium">
                        Mohon maaf atas ketidaknyamanannya. Website ini sedang dalam jangka waktu pemeliharaan dan tidak dapat digunakan untuk sementara waktu.
                    </p>
                </div>

                @php
                    $whatsappLinkOsis = \App\Models\Setting::get('whatsapp_group_link_osis', '');
                    $whatsappLinkMpk = \App\Models\Setting::get('whatsapp_group_link_mpk', '');
                @endphp

                {{-- HELPDESK & CONTACT CARD --}}
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-6 text-left space-y-4">
                    <h3 class="text-xs font-black text-slate-700 uppercase tracking-wider">
                        Layanan Bantuan & Informasi Panitia
                    </h3>

                    <p class="text-xs text-slate-600 font-medium leading-relaxed">
                        Apabila terdapat pertanyaan mendesak terkait pendaftaran atau pengumuman seleksi selama sistem nonaktif, Anda dapat menghubungi saluran resmi Panitia berikut:
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs pt-1">
                        <div class="bg-white border border-slate-200 p-4 rounded-xl space-y-2">
                            <span class="text-xs font-bold text-slate-800 block">Informasi Panitia OSIS</span>
                            <p class="text-[11px] text-slate-500 font-medium">Informasi & Bantuan Pendaftaran OSIS</p>
                            @if($whatsappLinkOsis)
                                <a href="{{ $whatsappLinkOsis }}" target="_blank" rel="noopener noreferrer" 
                                   class="inline-block pt-1 font-bold text-[#1E5BB8] hover:underline">
                                    Hubungi via WhatsApp Group OSIS &rarr;
                                </a>
                            @else
                                <span class="inline-block pt-1 text-slate-500 font-semibold">Saluran Resmi OSIS SMKS Nurul Islam</span>
                            @endif
                        </div>

                        <div class="bg-white border border-slate-200 p-4 rounded-xl space-y-2">
                            <span class="text-xs font-bold text-slate-800 block">Informasi Panitia MPK</span>
                            <p class="text-[11px] text-slate-500 font-medium">Informasi & Bantuan Pendaftaran MPK</p>
                            @if($whatsappLinkMpk)
                                <a href="{{ $whatsappLinkMpk }}" target="_blank" rel="noopener noreferrer" 
                                   class="inline-block pt-1 font-bold text-[#1E5BB8] hover:underline">
                                    Hubungi via WhatsApp Group MPK &rarr;
                                </a>
                            @else
                                <span class="inline-block pt-1 text-slate-500 font-semibold">Saluran Resmi MPK SMKS Nurul Islam</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button onclick="window.location.reload()" 
                            class="px-6 py-3 bg-[#1E5BB8] hover:bg-[#1A4F9C] active:bg-[#153F7C] text-white font-black text-xs rounded-xl shadow-md hover:shadow-lg transition">
                        Muat Ulang Halaman
                    </button>
                </div>

            </div>

        </main>

        {{-- FOOTER --}}
        <footer class="bg-white border-t border-slate-200 py-8 px-6 text-center text-xs text-slate-500 font-medium space-y-3">
            <div class="flex items-center justify-center gap-2">
                <img src="{{ asset('images/logo_osis.jpg') }}" alt="Logo OSIS MPK" class="w-6 h-6 rounded-full object-cover border border-slate-200">
                <span class="font-black text-slate-800">GAMANANTHA ANVAYA</span>
            </div>
            <p>&copy; {{ date('Y') }} Panitia Seleksi OSIS & MPK GAMANANTHA ANVAYA. All Rights Reserved.</p>
        </footer>

    </body>
</html>
