<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-extrabold text-xl sm:text-2xl text-white leading-tight flex items-center gap-3">
                <span>Pengaturan Sistem & Access Control</span>
                <span class="text-xs px-3 py-1 rounded-full bg-white/20 text-white font-extrabold border border-white/30">
                    Admin-02 Panel
                </span>
            </h2>
            <p class="text-xs text-sky-200 font-medium mt-0.5">
                Kelola jadwal pengumuman kelulusan publik & tautan grup WhatsApp calon pengurus OSIS/MPK
            </p>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto space-y-8">

        {{-- Alert Flash Success Message --}}
        @if (session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-950 text-sm flex items-center justify-between shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 font-bold shadow-md">✓</div>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- MAIN FORM PENGATURAN --}}
        <form method="POST" action="{{ route('penerimaan.updateSetting') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- CARD 1: PENGATURAN AKSES & JADWAL PENGUMUMAN --}}
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-[#1E5BB8] to-[#1A4F9C] text-white flex items-center justify-center font-black text-lg shadow-md shadow-blue-700/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-base font-black text-slate-900">Pengaturan Akses & Jadwal Pengumuman Kelulusan</h4>
                            <p class="text-xs text-slate-500 font-medium">Atur status akses dan jadwal hitungan mundur pengumuman publik (<code class="bg-slate-100 px-1.5 py-0.5 rounded text-blue-800">/pengumuman</code>)</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-xs font-extrabold px-3 py-1.5 rounded-full border flex items-center gap-2
                            {{ $announcementStatus === 'published' ? 'bg-emerald-50 text-emerald-800 border-emerald-300' : ($announcementStatus === 'scheduled' ? 'bg-blue-50 text-blue-800 border-blue-300' : 'bg-amber-50 text-amber-800 border-amber-300') }}">
                            <span class="w-2 h-2 rounded-full {{ $announcementStatus === 'published' ? 'bg-emerald-500 animate-pulse' : ($announcementStatus === 'scheduled' ? 'bg-blue-500 animate-pulse' : 'bg-amber-500') }}"></span>
                            Status: 
                            {{ $announcementStatus === 'published' ? 'Langsung Dibuka' : ($announcementStatus === 'scheduled' ? 'Hitung Mundur (Scheduled)' : 'Belum Diset / Rekrutmen Berlangsung') }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-start">
                    
                    {{-- Status Selector --}}
                    <div class="md:col-span-7 space-y-2" 
                         x-data="{ 
                            openStatusMenu: false,
                            statusValue: '{{ $announcementStatus }}',
                            getStatusLabel(val) {
                                if(val === 'published') return 'Buka Langsung Sekarang (Form Cek Kelulusan Aktif)';
                                if(val === 'scheduled') return 'Jadwalkan Hitungan Mundur (Countdown Timer)';
                                return 'Belum Diset (Tampilkan Proses Rekrutmen Berlangsung)';
                            }
                         }">
                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700">
                            Pilih Mode Akses Pengumuman *
                        </label>
                        <input type="hidden" name="announcement_status" :value="statusValue">

                        <div class="relative">
                            <button type="button" 
                                    @click="openStatusMenu = !openStatusMenu" 
                                    class="w-full py-3.5 px-4 bg-[#F8FAFC] hover:bg-slate-100 border border-slate-300 rounded-xl text-xs font-bold text-slate-900 flex items-center justify-between transition focus:outline-none focus:ring-4 focus:ring-blue-600/20 shadow-sm">
                                <div class="flex items-center gap-2.5 min-w-0 truncate">
                                    <template x-if="statusValue === 'published'">
                                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shrink-0"></span>
                                    </template>
                                    <template x-if="statusValue === 'scheduled'">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shrink-0"></span>
                                    </template>
                                    <template x-if="statusValue !== 'published' && statusValue !== 'scheduled'">
                                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shrink-0"></span>
                                    </template>
                                    <span x-text="getStatusLabel(statusValue)" class="truncate"></span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 shrink-0 transition-transform duration-200" :class="openStatusMenu ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="openStatusMenu" 
                                 @click.away="openStatusMenu = false" 
                                 x-cloak 
                                 class="absolute left-0 right-0 mt-2 bg-white border border-slate-200 rounded-2xl shadow-xl z-30 py-2 text-xs font-semibold space-y-1 animate-fade-in divide-y divide-slate-100">
                                
                                <div @click="statusValue = 'draft'; openStatusMenu = false" 
                                     class="px-4 py-3 hover:bg-amber-50 hover:text-amber-900 cursor-pointer transition flex items-center justify-between gap-2"
                                     :class="statusValue === 'draft' ? 'bg-amber-50/80 font-black text-amber-900' : 'text-slate-800'">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shrink-0"></span>
                                        <span>Belum Diset (Tampilkan "Proses Rekrutmen Berlangsung")</span>
                                    </div>
                                    <template x-if="statusValue === 'draft'">
                                        <span class="text-xs font-black text-amber-600">✓</span>
                                    </template>
                                </div>

                                <div @click="statusValue = 'scheduled'; openStatusMenu = false" 
                                     class="px-4 py-3 hover:bg-blue-50 hover:text-[#1E5BB8] cursor-pointer transition flex items-center justify-between gap-2"
                                     :class="statusValue === 'scheduled' ? 'bg-blue-50/80 font-black text-[#1E5BB8]' : 'text-slate-800'">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shrink-0"></span>
                                        <span>Jadwalkan Hitungan Mundur (Countdown Timer)</span>
                                    </div>
                                    <template x-if="statusValue === 'scheduled'">
                                        <span class="text-xs font-black text-[#1E5BB8]">✓</span>
                                    </template>
                                </div>

                                <div @click="statusValue = 'published'; openStatusMenu = false" 
                                     class="px-4 py-3 hover:bg-emerald-50 hover:text-emerald-900 cursor-pointer transition flex items-center justify-between gap-2"
                                     :class="statusValue === 'published' ? 'bg-emerald-50/80 font-black text-emerald-900' : 'text-slate-800'">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>Buka Langsung Sekarang (Form Cek Kelulusan Aktif)</span>
                                    </div>
                                    <template x-if="statusValue === 'published'">
                                        <span class="text-xs font-black text-emerald-600">✓</span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Datetime Picker --}}
                    <div class="md:col-span-5 space-y-2">
                        <label for="announcement_datetime" class="block text-xs font-black uppercase tracking-wider text-slate-700">
                            Tanggal & Jam Pengumuman (Jikamana Scheduled)
                        </label>
                        <input type="datetime-local" 
                               id="announcement_datetime" 
                               name="announcement_datetime" 
                               value="{{ old('announcement_datetime', $announcementDatetime ? \Carbon\Carbon::parse($announcementDatetime)->format('Y-m-d\TH:i') : '') }}" 
                               class="w-full py-3.5 px-4 bg-slate-50 border border-slate-300 rounded-xl text-xs font-extrabold text-slate-900 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                    </div>

                </div>
            </div>

            {{-- CARD 2: PENGATURAN TAUTAN & UPLOAD QR CODE GRUP WHATSAPP --}}
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm space-y-6">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-emerald-700/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-base font-black text-slate-900">Pengaturan Tautan & Gambar QR Code Grup WhatsApp</h4>
                        <p class="text-xs text-slate-500 font-medium">Calon pengurus yang lolos akan melihat tombol & gambar QR Code resmi untuk bergabung ke grup WhatsApp.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    {{-- OSIS SECTION --}}
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-5">
                        <div class="flex items-center gap-2 border-b border-slate-200 pb-3">
                            <span class="w-3 h-3 rounded-full bg-blue-600"></span>
                            <h5 class="text-sm font-black text-slate-900">Grup WhatsApp Calon Pengurus OSIS</h5>
                        </div>

                        {{-- Link Input --}}
                        <div class="space-y-2">
                            <label for="whatsapp_group_link_osis" class="block text-xs font-black uppercase tracking-wider text-slate-700">
                                Tautan Link Grup WhatsApp OSIS
                            </label>
                            <input type="url" 
                                   id="whatsapp_group_link_osis" 
                                   name="whatsapp_group_link_osis" 
                                   value="{{ old('whatsapp_group_link_osis', $whatsappLinkOsis) }}" 
                                   placeholder="Contoh: https://chat.whatsapp.com/..." 
                                   class="w-full py-3 px-3.5 bg-white border border-slate-300 rounded-xl text-xs font-bold text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                            @error('whatsapp_group_link_osis')
                                <p class="text-xs text-rose-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- File Upload QR Code Image --}}
                        <div class="space-y-2">
                            <label for="whatsapp_qr_osis" class="block text-xs font-black uppercase tracking-wider text-slate-700">
                                Upload Gambar QR Code Grup OSIS
                            </label>
                            <input type="file" 
                                   id="whatsapp_qr_osis" 
                                   name="whatsapp_qr_osis" 
                                   accept="image/png,image/jpeg,image/jpg,image/webp" 
                                   class="w-full text-xs text-slate-600 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition cursor-pointer bg-white border border-slate-300 rounded-xl p-1" />
                            <p class="text-[11px] text-slate-500 font-medium">Format: PNG, JPG, WEBP. Maksimal 2MB.</p>
                            @error('whatsapp_qr_osis')
                                <p class="text-xs text-rose-600 font-semibold">{{ $message }}</p>
                            @enderror

                            {{-- Current Image Preview --}}
                            @if (!empty($whatsappQrOsis))
                                <div class="pt-2 flex items-center gap-3">
                                    <div class="w-20 h-20 rounded-xl overflow-hidden border border-slate-300 bg-white p-1 shadow-sm shrink-0">
                                        <img src="{{ asset($whatsappQrOsis) }}" alt="QR Code OSIS" class="w-full h-full object-contain">
                                    </div>
                                    <div class="text-xs text-slate-600 space-y-1">
                                        <p class="font-bold text-emerald-600 flex items-center gap-1">
                                            <span>✓</span> Gambar QR Aktif
                                        </p>
                                        <p class="text-[10px] text-slate-400">File tersimpan dan akan ditampilkan di hasil pengumuman.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- MPK SECTION --}}
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-5">
                        <div class="flex items-center gap-2 border-b border-slate-200 pb-3">
                            <span class="w-3 h-3 rounded-full bg-purple-600"></span>
                            <h5 class="text-sm font-black text-slate-900">Grup WhatsApp Calon Pengurus MPK</h5>
                        </div>

                        {{-- Link Input --}}
                        <div class="space-y-2">
                            <label for="whatsapp_group_link_mpk" class="block text-xs font-black uppercase tracking-wider text-slate-700">
                                Tautan Link Grup WhatsApp MPK
                            </label>
                            <input type="url" 
                                   id="whatsapp_group_link_mpk" 
                                   name="whatsapp_group_link_mpk" 
                                   value="{{ old('whatsapp_group_link_mpk', $whatsappLinkMpk) }}" 
                                   placeholder="Contoh: https://chat.whatsapp.com/..." 
                                   class="w-full py-3 px-3.5 bg-white border border-slate-300 rounded-xl text-xs font-bold text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                            @error('whatsapp_group_link_mpk')
                                <p class="text-xs text-rose-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- File Upload QR Code Image --}}
                        <div class="space-y-2">
                            <label for="whatsapp_qr_mpk" class="block text-xs font-black uppercase tracking-wider text-slate-700">
                                Upload Gambar QR Code Grup MPK
                            </label>
                            <input type="file" 
                                   id="whatsapp_qr_mpk" 
                                   name="whatsapp_qr_mpk" 
                                   accept="image/png,image/jpeg,image/jpg,image/webp" 
                                   class="w-full text-xs text-slate-600 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-purple-600 file:text-white hover:file:bg-purple-700 transition cursor-pointer bg-white border border-slate-300 rounded-xl p-1" />
                            <p class="text-[11px] text-slate-500 font-medium">Format: PNG, JPG, WEBP. Maksimal 2MB.</p>
                            @error('whatsapp_qr_mpk')
                                <p class="text-xs text-rose-600 font-semibold">{{ $message }}</p>
                            @enderror

                            {{-- Current Image Preview --}}
                            @if (!empty($whatsappQrMpk))
                                <div class="pt-2 flex items-center gap-3">
                                    <div class="w-20 h-20 rounded-xl overflow-hidden border border-slate-300 bg-white p-1 shadow-sm shrink-0">
                                        <img src="{{ asset($whatsappQrMpk) }}" alt="QR Code MPK" class="w-full h-full object-contain">
                                    </div>
                                    <div class="text-xs text-slate-600 space-y-1">
                                        <p class="font-bold text-emerald-600 flex items-center gap-1">
                                            <span>✓</span> Gambar QR Aktif
                                        </p>
                                        <p class="text-[10px] text-slate-400">File tersimpan dan akan ditampilkan di hasil pengumuman.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="flex justify-end">
                <button type="submit" 
                        class="w-full sm:w-auto px-8 py-4 bg-[#1E5BB8] hover:bg-[#1A4F9C] active:bg-[#153F7C] text-white text-xs sm:text-sm font-black rounded-xl shadow-lg shadow-blue-700/20 hover:shadow-blue-700/30 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>SIMPAN PENGATURAN SISTEM</span>
                </button>
            </div>

        </form>

    </div>
</x-app-layout>
