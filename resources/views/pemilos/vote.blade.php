<x-pemilos-layout>
    <div class="py-4 sm:py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" 
         x-data="{ 
             selectedPaslon: null, 
             isSubmitting: false, 
             showThankYou: false,
             votedPaslonNumber: null,
             countdown: 4,
             openModal(paslon) {
                 this.selectedPaslon = paslon;
             },
             closeModal() {
                 this.selectedPaslon = null;
             },
             submitVote() {
                 if (!this.selectedPaslon || this.isSubmitting) return;
                 this.isSubmitting = true;

                 fetch('{{ route('pemilos.storeVote') }}', {
                     method: 'POST',
                     headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': '{{ csrf_token() }}',
                         'Accept': 'application/json'
                     },
                     body: JSON.stringify({ paslon_id: this.selectedPaslon.id })
                 })
                 .then(res => res.json())
                 .then(data => {
                     this.isSubmitting = false;
                     if (data.success) {
                         this.votedPaslonNumber = this.selectedPaslon.paslon_number;
                         this.selectedPaslon = null;
                         this.showThankYou = true;
                         this.startCountdown();
                     } else {
                         alert(data.message || 'Gagal menyimpan pilihan.');
                     }
                 })
                 .catch(err => {
                     this.isSubmitting = false;
                     alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                 });
             },
             startCountdown() {
                 this.countdown = 4;
                 let interval = setInterval(() => {
                     this.countdown--;
                     if (this.countdown <= 0) {
                         clearInterval(interval);
                         this.showThankYou = false;
                     }
                 }, 1000);
             }
         }">

        <!-- Compact Header Banner -->
        <div class="mb-5 p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-[#0F264A] via-[#153F7C] to-[#1E5BB8] text-white shadow-md border border-sky-400/20 relative overflow-hidden">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 relative z-10">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-sky-400/20 text-sky-200 text-[10px] font-black uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        SURAT SUARA E-VOTING OSIS 2026/2027
                    </div>
                    <h2 class="text-base sm:text-xl font-black text-white tracking-tight">
                        Silakan Tekan Tombol Pilih Pada Pasangan Calon Pilihan Anda
                    </h2>
                </div>

                <div class="shrink-0 self-end sm:self-auto">
                    <a href="{{ route('pemilos.realcount') }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-extrabold text-xs shadow-md transition transform hover:-translate-y-0.5 border border-emerald-400/30">
                        <svg class="w-4 h-4 text-emerald-200 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Lihat Real Count Realtime</span>
                    </a>
                </div>
            </div>
        </div>

        @if($mappings->isEmpty())
            <!-- Empty State if no paslon mapped -->
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm border border-slate-200">
                <div class="w-12 h-12 mx-auto rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h4 class="text-base font-bold text-slate-800">Belum Ada Pemetaan Paslon OSIS</h4>
                <p class="text-slate-500 text-xs max-w-md mx-auto mt-1">
                    Silakan atur pemetaan Paslon OSIS terlebih dahulu melalui akun Admin-02.
                </p>
            </div>
        @else
            <!-- Dynamic Grid: Fits 2 or 3 Paslon neatly on Tablet & Desktop -->
            <div class="grid grid-cols-1 {{ $mappings->count() == 2 ? 'md:grid-cols-2 max-w-4xl' : ($mappings->count() == 3 ? 'md:grid-cols-3 max-w-7xl' : 'md:grid-cols-2 lg:grid-cols-3 max-w-7xl') }} mx-auto gap-4 sm:gap-5">
                @foreach($mappings as $mapping)
                    @php
                        $paslonData = [
                            'id' => $mapping->id,
                            'paslon_number' => $mapping->paslon_number,
                            'chairman_name' => $mapping->chairman ? $mapping->chairman->full_name : 'Belum di-mapping',
                            'chairman_class' => $mapping->chairman ? $mapping->chairman->class_name : '-',
                            'vice_chairman_name' => $mapping->viceChairman ? $mapping->viceChairman->full_name : 'Belum di-mapping',
                            'vice_chairman_class' => $mapping->viceChairman ? $mapping->viceChairman->class_name : '-',
                            'photo_url' => $mapping->photo_url,
                            'vision' => $mapping->vision ?? 'Visi belum diisi.',
                            'mission' => $mapping->mission ?? 'Misi belum diisi.',
                        ];
                    @endphp

                    <div class="group bg-white rounded-2xl overflow-hidden border-2 border-slate-200 hover:border-blue-600 shadow-md hover:shadow-xl transition duration-300 flex flex-col justify-between transform hover:-translate-y-0.5">
                        
                        <!-- Header Paslon Number -->
                        <div class="bg-gradient-to-r from-[#0F264A] via-[#153F7C] to-[#1E5BB8] px-4 py-2.5 flex items-center justify-between text-white border-b border-blue-400/30">
                            <div class="flex items-center gap-2.5">
                                <span class="w-9 h-9 rounded-xl bg-white text-[#0F264A] font-black text-lg flex items-center justify-center shadow-md">
                                    0{{ $mapping->paslon_number }}
                                </span>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-black tracking-wider uppercase">PASLON NO. 0{{ $mapping->paslon_number }}</h3>
                                    <p class="text-[10px] text-sky-200 font-extrabold">Kandidat Ketua & Wakil OSIS</p>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded-full bg-white/20 text-[10px] font-black uppercase tracking-widest text-sky-100">
                                OSIS
                            </span>
                        </div>

                        <!-- Card Body (Compact Photo & Side-by-Side Candidates) -->
                        <div class="p-4 space-y-3 flex-1 flex flex-col justify-between">
                            
                            <!-- Foto Paslon -->
                            <div class="relative w-full h-36 sm:h-40 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 group-hover:border-blue-300 transition">
                                @if($mapping->photo_url)
                                    <img src="{{ $mapping->photo_url }}" alt="Foto Paslon {{ $mapping->paslon_number }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 text-slate-400 p-2 text-center">
                                        <svg class="w-10 h-10 mb-1 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="text-xs font-bold">Foto Belum Diunggah</span>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-80"></div>
                                <div class="absolute bottom-2 left-3 right-3 flex justify-between items-center text-white">
                                    <span class="px-2 py-0.5 rounded bg-blue-600/90 backdrop-blur-md text-[10px] font-black uppercase tracking-wider">
                                        PASLON #0{{ $mapping->paslon_number }}
                                    </span>
                                </div>
                            </div>

                            <!-- Detail Calon Ketua & Wakil (COMPACT 2 COLUMNS SIDE-BY-SIDE) -->
                            <div class="grid grid-cols-2 gap-2 text-left">
                                <!-- Calon Ketua (Left) -->
                                <div class="p-2.5 rounded-xl bg-blue-50/70 border border-blue-200/80 group-hover:bg-blue-100/60 transition flex flex-col justify-between">
                                    <div>
                                        <span class="text-[9px] font-black uppercase text-blue-700 block mb-0.5">
                                            KETUA OSIS
                                        </span>
                                        <h4 class="text-xs font-black text-slate-900 leading-snug line-clamp-1">
                                            {{ $mapping->chairman ? $mapping->chairman->full_name : 'Belum di-mapping' }}
                                        </h4>
                                    </div>
                                    @if($mapping->chairman)
                                        <div class="mt-1 pt-1 border-t border-blue-200/50 text-[10px] text-slate-500 font-medium">
                                            Kelas: <span class="font-bold text-slate-800">{{ $mapping->chairman->class_name }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Calon Wakil (Right) -->
                                <div class="p-2.5 rounded-xl bg-sky-50/70 border border-sky-200/80 group-hover:bg-sky-100/60 transition flex flex-col justify-between">
                                    <div>
                                        <span class="text-[9px] font-black uppercase text-sky-700 block mb-0.5">
                                            WAKIL KETUA
                                        </span>
                                        <h4 class="text-xs font-black text-slate-900 leading-snug line-clamp-1">
                                            {{ $mapping->viceChairman ? $mapping->viceChairman->full_name : 'Belum di-mapping' }}
                                        </h4>
                                    </div>
                                    @if($mapping->viceChairman)
                                        <div class="mt-1 pt-1 border-t border-sky-200/50 text-[10px] text-slate-500 font-medium">
                                            Kelas: <span class="font-bold text-slate-800">{{ $mapping->viceChairman->class_name }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Visi Ringkas -->
                            @if($mapping->vision)
                                <div class="p-2 rounded-xl bg-slate-50 border border-slate-200 text-[10px] space-y-0.5">
                                    <p class="font-bold text-slate-700 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Visi Paslon:</span>
                                    </p>
                                    <p class="text-slate-600 line-clamp-1 italic">"{{ $mapping->vision }}"</p>
                                </div>
                            @endif

                        </div>

                        <!-- Action Button Pilih -->
                        <div class="p-4 pt-0">
                            <button @click="openModal({{ json_encode($paslonData) }})" 
                                    type="button"
                                    class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-[#0F264A] via-[#1E5BB8] to-blue-600 hover:from-blue-700 hover:to-indigo-800 text-white font-black text-xs sm:text-sm shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-1.5 border border-blue-400/30">
                                <svg class="w-4 h-4 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>PILIH PASLON NO. 0{{ $mapping->paslon_number }}</span>
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

        <!-- MODAL KONFIRMASI PEMILIHAN (SEDERHANA, RAPI & MINIMALIS) -->
        <div x-cloak 
             x-show="selectedPaslon !== null" 
             class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/70 backdrop-blur-sm flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">

            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 text-center relative" @click.away="closeModal()">
                
                <!-- Simple Question Icon -->
                <div class="w-12 h-12 mx-auto rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <!-- Title & Subtitle -->
                <h3 class="text-lg font-extrabold text-slate-900">Konfirmasi Pilihan Suara</h3>
                <p class="text-xs text-slate-500 mt-1">Apakah Anda yakin memilih pasangan calon ini?</p>

                <!-- Simple Paslon Card Summary -->
                <div class="my-4 p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-center space-y-1.5">
                    <span class="inline-block px-3 py-0.5 rounded-full bg-blue-600 text-white text-[10px] font-black uppercase tracking-wider">
                        PASLON NO. 0<span x-text="selectedPaslon ? selectedPaslon.paslon_number : ''"></span>
                    </span>
                    <p class="text-sm font-black text-slate-900">
                        <span x-text="selectedPaslon ? selectedPaslon.chairman_name : ''"></span> 
                        <span class="text-slate-400 font-normal">&</span> 
                        <span x-text="selectedPaslon ? selectedPaslon.vice_chairman_name : ''"></span>
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-3 mt-5">
                    <button @click="closeModal()" 
                            type="button" 
                            :disabled="isSubmitting"
                            class="flex-1 py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                        Batal
                    </button>
                    <button @click="submitVote()" 
                            type="button" 
                            :disabled="isSubmitting"
                            class="flex-1 py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-600/20 flex items-center justify-center gap-1.5 transition">
                        <template x-if="isSubmitting">
                            <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </template>
                        <span x-text="isSubmitting ? 'Memproses...' : 'Ya, Konfirmasi'"></span>
                    </button>
                </div>

            </div>
        </div>

        <!-- FULL-SCREEN OVERLAY THANK YOU (CLEAN SOLID CHECKMARK - NO BOUNCING) -->
        <div x-cloak 
             x-show="showThankYou" 
             class="fixed inset-0 z-50 bg-[#0F264A] text-white flex flex-col items-center justify-center p-6 text-center"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            
            <div class="max-w-md w-full space-y-5">
                
                <!-- CLEAN SOLID CHECKMARK ICON (STATIC & ELEGANT) -->
                <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-tr from-emerald-400 to-teal-500 text-white flex items-center justify-center shadow-2xl shadow-emerald-500/40 border-4 border-white/30">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div class="space-y-1.5">
                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 font-black text-[10px] tracking-widest uppercase border border-emerald-500/30">
                        VOTE TERKIRIM
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                        TERIMA KASIH TELAH MEMILIH!
                    </h2>
                    <p class="text-sky-200 text-xs sm:text-sm leading-relaxed">
                        Suara Anda untuk <strong class="text-white font-black underline">Paslon No. 0<span x-text="votedPaslonNumber"></span></strong> telah berhasil dicatat secara aman.
                    </p>
                </div>

                <!-- Progress Loading Bar & Countdown -->
                <div class="p-5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 space-y-2.5">
                    <div class="flex items-center justify-between text-xs font-bold text-sky-200">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 animate-spin text-emerald-300" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mempersiapkan bilik suara berikutnya...
                        </span>
                        <span class="text-emerald-400 font-black text-sm" x-text="countdown + 's'"></span>
                    </div>

                    <div class="w-full h-2.5 bg-slate-800/80 rounded-full overflow-hidden p-0.5 border border-white/10">
                        <div class="h-full bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full transition-all duration-1000 ease-linear"
                             :style="'width: ' + ((4 - countdown) / 4 * 100) + '%'"></div>
                    </div>
                </div>

                <p class="text-[10px] text-sky-300/70 font-mono">
                    GAMANANTHA ANVAYA 2026/2027 • Standardized Protection
                </p>
            </div>
        </div>

    </div>
</x-pemilos-layout>
