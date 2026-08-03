<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-white leading-tight flex items-center gap-3">
                    <span>Mapping Pasangan Calon (Paslon) {{ $activeOrg }}</span>
                    <span class="text-xs px-3 py-1 rounded-full bg-white/20 text-white font-extrabold border border-white/30">
                        Periode 2026/2027
                    </span>
                </h2>
                <p class="text-xs text-sky-200 font-medium mt-0.5">
                    Geser (drag & drop) kandidat dari daftar kiri langsung ke kartu kosong Paslon di kanan.
                </p>
            </div>

            <!-- Sub-Menu Navigation Tabs (OSIS vs MPK) -->
            <div class="flex items-center gap-2 bg-white/10 p-1.5 rounded-2xl border border-white/20 shadow-inner">
                <a href="{{ route('penerimaan.mapping.osis') }}" 
                   class="px-4 py-2 rounded-xl text-xs font-black transition flex items-center gap-2 {{ $activeOrg === 'OSIS' ? 'bg-white text-[#1E5BB8] shadow-md' : 'text-white hover:bg-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Mapping Calon OSIS</span>
                </a>
                <a href="{{ route('penerimaan.mapping.mpk') }}" 
                   class="px-4 py-2 rounded-xl text-xs font-black transition flex items-center gap-2 {{ $activeOrg === 'MPK' ? 'bg-white text-[#1E5BB8] shadow-md' : 'text-white hover:bg-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0V8m0 3h4m-4 0H7" />
                    </svg>
                    <span>Mapping Calon MPK</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8"
         x-data="{
            searchCandidate: '',
            draggedCandidate: null,
            
            // Map tracking slotKey -> candidateId (realtime)
            assignedMap: {},

            isCandidateAssigned(id) {
                if(!id) return false;
                return Object.values(this.assignedMap).some(val => String(val) === String(id) && val !== '' && val !== null);
            },

            setSlotAssignment(slotKey, id) {
                if (id) {
                    this.assignedMap[slotKey] = String(id);
                } else {
                    delete this.assignedMap[slotKey];
                }
            },

            // Delete confirmation state
            deleteModal: {
                open: false,
                formId: null,
                title: ''
            },
            confirmDelete(formId, paslonNum) {
                this.deleteModal.formId = formId;
                this.deleteModal.title = 'Hapus Kartu Paslon No. ' + paslonNum;
                this.deleteModal.open = true;
            },
            submitDelete() {
                if (this.deleteModal.formId) {
                    document.getElementById(this.deleteModal.formId).submit();
                }
            }
         }">

        {{-- Flash Success Alert --}}
        @if (session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-950 text-sm flex items-center justify-between shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 font-bold shadow-md">✓</div>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- Flash Error Alert --}}
        @if ($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-950 text-sm space-y-1 shadow-sm">
                <div class="font-bold flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-rose-600 text-white flex items-center justify-center text-xs font-black">!</span>
                    <span>Terdapat kesalahan pengisian form:</span>
                </div>
                <ul class="list-disc list-inside text-xs pl-8 font-medium text-rose-800">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Action Header Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-3xl border border-slate-200/80 shadow-sm">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100/80 text-[#1E5BB8] text-xs font-extrabold mb-1 border border-blue-200">
                    <span class="w-2 h-2 rounded-full bg-[#1E5BB8]"></span>
                    Canvas Pemetaan Paslon {{ $activeOrg }}
                </div>
                <h3 class="text-xl font-black text-slate-900">Kartu Mapping Pasangan Calon {{ $activeOrg }}</h3>
                <p class="text-xs text-slate-500 font-medium">
                    Tarik (drag) calon dari daftar di kiri, lalu lepas (drop) pada slot Ketua & Wakil Ketua di kartu pilihan.
                </p>
            </div>
            
            <!-- Direct Instant Add Card Action Form -->
            <form method="POST" action="{{ route('penerimaan.mapping.store') }}">
                @csrf
                <input type="hidden" name="organization_type" value="{{ $activeOrg }}">
                <input type="hidden" name="paslon_number" value="{{ ($mappings->max('paslon_number') ?? 0) + 1 }}">
                
                <button type="submit" 
                        class="w-full sm:w-auto px-5 py-3 bg-[#1E5BB8] hover:bg-[#1A4F9C] active:bg-[#153F7C] text-white text-xs font-black rounded-xl shadow-lg shadow-blue-700/20 hover:shadow-blue-700/30 transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Tambah Kartu Paslon Baru (No. {{ ($mappings->max('paslon_number') ?? 0) + 1 }})</span>
                </button>
            </form>
        </div>

        <!-- MAIN GRID: Candidate Pool Sidebar & Cards Canvas -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- LEFT SIDEBAR: Available Candidates Drag Pool -->
            <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200/80 p-5 shadow-sm space-y-4 lg:sticky lg:top-8">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-[#1E5BB8] animate-pulse"></span>
                        <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider">
                            Calon Terdaftar ({{ $candidates->count() }})
                        </h4>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-[10px] bg-blue-50 text-[#1E5BB8] font-extrabold px-2.5 py-1 rounded-full border border-blue-200">
                        <svg class="w-3.5 h-3.5 text-[#1E5BB8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" />
                        </svg>
                        Drag Item
                    </span>
                </div>

                <!-- Search candidate input -->
                <div class="relative">
                    <input type="text" 
                           x-model="searchCandidate" 
                           placeholder="Cari calon {{ $activeOrg }}..." 
                           class="w-full pl-9 pr-3 py-2 bg-[#F8FAFC] border border-slate-300 rounded-xl text-xs font-semibold text-slate-900 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 outline-none transition" />
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Candidate List with Realtime Assignment Check -->
                <div class="space-y-2.5 max-h-[580px] overflow-y-auto pr-1">
                    @forelse($candidates as $candidate)
                        <div x-show="!searchCandidate || '{{ strtolower($candidate->full_name) }}'.includes(searchCandidate.toLowerCase()) || '{{ strtolower($candidate->registration_number) }}'.includes(searchCandidate.toLowerCase())"
                             :draggable="!isCandidateAssigned({{ $candidate->id }})"
                             @dragstart="
                                if (isCandidateAssigned({{ $candidate->id }})) {
                                    $event.preventDefault();
                                    return;
                                }
                                draggedCandidate = { id: {{ $candidate->id }}, name: '{{ addslashes($candidate->full_name) }}', class: '{{ addslashes($candidate->class_name) }}', reg: '{{ $candidate->registration_number }}' }; 
                                $event.dataTransfer.setData('text/plain', JSON.stringify(draggedCandidate));
                             "
                             class="p-3.5 rounded-2xl border transition-all duration-200 flex items-center justify-between gap-3 group"
                             :class="isCandidateAssigned({{ $candidate->id }}) 
                                ? 'bg-slate-50 border-slate-200 opacity-50 cursor-not-allowed select-none' 
                                : 'bg-white border-slate-200 hover:border-[#1E5BB8] hover:shadow-md cursor-grab active:cursor-grabbing hover:-translate-y-0.5'">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center font-black text-xs shrink-0 shadow-sm"
                                     :class="isCandidateAssigned({{ $candidate->id }}) ? 'bg-slate-200 text-slate-500' : 'bg-blue-100 text-[#1E5BB8]'">
                                    {{ substr($candidate->full_name, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <h5 class="text-xs font-black text-slate-900 group-hover:text-[#1E5BB8] truncate">
                                        {{ $candidate->full_name }}
                                    </h5>
                                    <p class="text-[10px] text-slate-500 font-semibold truncate">
                                        {{ $candidate->registration_number }} • {{ $candidate->class_name }}
                                    </p>
                                </div>
                            </div>

                            <template x-if="isCandidateAssigned({{ $candidate->id }})">
                                <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-slate-200 text-slate-600 border border-slate-300 shrink-0">
                                    Sudah Dipetakan
                                </span>
                            </template>

                            <template x-if="!isCandidateAssigned({{ $candidate->id }})">
                                <div class="flex items-center gap-1 shrink-0">
                                    <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-[#1E5BB8] bg-blue-50 px-2 py-1 rounded-lg border border-blue-200 group-hover:bg-[#1E5BB8] group-hover:text-white transition">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" />
                                        </svg>
                                        <span>Tarik</span>
                                    </span>
                                </div>
                            </template>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400 text-xs font-semibold">
                            Belum ada data calon {{ $activeOrg }} terdaftar.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- RIGHT SECTION: MAPPED PASLON CARDS CANVAS -->
            <div class="lg:col-span-8 space-y-6">

                @foreach($mappings as $mapping)
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-md overflow-hidden transition-all"
                         x-data="{
                            isDragOverKetua: false,
                            isDragOverWakil: false,
                            openKetuaSelect: false,
                            openWakilSelect: false,
                            
                            chairmanId: '{{ $mapping->chairman_id ?? '' }}',
                            chairmanName: '{{ $mapping->chairman ? addslashes($mapping->chairman->full_name) : '' }}',
                            chairmanClass: '{{ $mapping->chairman ? addslashes($mapping->chairman->class_name) : '' }}',
                            chairmanReg: '{{ $mapping->chairman ? $mapping->chairman->registration_number : '' }}',
                            
                            viceChairmanId: '{{ $mapping->vice_chairman_id ?? '' }}',
                            viceChairmanName: '{{ $mapping->viceChairman ? addslashes($mapping->viceChairman->full_name) : '' }}',
                            viceChairmanClass: '{{ $mapping->viceChairman ? addslashes($mapping->viceChairman->class_name) : '' }}',
                            viceChairmanReg: '{{ $mapping->viceChairman ? $mapping->viceChairman->registration_number : '' }}',
                            
                            photoPreview: '{{ $mapping->photo_url ?? '' }}',
                            
                            init() {
                                setSlotAssignment('c_{{ $mapping->id }}', this.chairmanId);
                                setSlotAssignment('v_{{ $mapping->id }}', this.viceChairmanId);
                            },

                            handleChairmanDrop(e) {
                                this.isDragOverKetua = false;
                                e.preventDefault();
                                try {
                                    const data = JSON.parse(e.dataTransfer.getData('text/plain') || '{}');
                                    if(data.id) {
                                        // If already assigned elsewhere and not to this exact slot, reject drop
                                        if (isCandidateAssigned(data.id) && String(this.chairmanId) !== String(data.id)) {
                                            return;
                                        }
                                        setSlotAssignment('c_{{ $mapping->id }}', data.id);
                                        this.chairmanId = data.id;
                                        this.chairmanName = data.name;
                                        this.chairmanClass = data.class;
                                        this.chairmanReg = data.reg;
                                    }
                                } catch(err){}
                            },
                            handleViceDrop(e) {
                                this.isDragOverWakil = false;
                                e.preventDefault();
                                try {
                                    const data = JSON.parse(e.dataTransfer.getData('text/plain') || '{}');
                                    if(data.id) {
                                        // If already assigned elsewhere and not to this exact slot, reject drop
                                        if (isCandidateAssigned(data.id) && String(this.viceChairmanId) !== String(data.id)) {
                                            return;
                                        }
                                        setSlotAssignment('v_{{ $mapping->id }}', data.id);
                                        this.viceChairmanId = data.id;
                                        this.viceChairmanName = data.name;
                                        this.viceChairmanClass = data.class;
                                        this.viceChairmanReg = data.reg;
                                    }
                                } catch(err){}
                            },
                            clearChairman() {
                                setSlotAssignment('c_{{ $mapping->id }}', null);
                                this.chairmanId = '';
                                this.chairmanName = '';
                                this.chairmanClass = '';
                                this.chairmanReg = '';
                            },
                            clearVice() {
                                setSlotAssignment('v_{{ $mapping->id }}', null);
                                this.viceChairmanId = '';
                                this.viceChairmanName = '';
                                this.viceChairmanClass = '';
                                this.viceChairmanReg = '';
                            },
                            previewFile(e) {
                                const file = e.target.files[0];
                                if(file) {
                                    this.photoPreview = URL.createObjectURL(file);
                                }
                            }
                         }">

                        <!-- Update Form Body -->
                        <form method="POST" action="{{ route('penerimaan.mapping.update', $mapping) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="chairman_id" :value="chairmanId">
                            <input type="hidden" name="vice_chairman_id" :value="viceChairmanId">

                            <!-- Card Top Bar Header -->
                            <div class="px-6 py-4 bg-gradient-to-r from-[#1E5BB8] via-[#1A4F9C] to-[#153F7C] text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center font-black text-xl border border-white/30 shadow-sm shrink-0">
                                        {{ sprintf('%02d', $mapping->paslon_number) }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <label class="text-xs font-black uppercase text-sky-200 whitespace-nowrap">Nomor Urut:</label>
                                        <input type="number" 
                                               name="paslon_number" 
                                               value="{{ $mapping->paslon_number }}" 
                                               min="1" 
                                               required
                                               class="w-16 py-1 px-2.5 bg-white/20 border border-white/40 rounded-xl text-xs font-black text-white focus:bg-white focus:text-slate-900 outline-none transition text-center" />
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <button type="submit" 
                                            class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black rounded-xl shadow-md transition flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Simpan Paslon {{ $mapping->paslon_number }}</span>
                                    </button>

                                    <button type="button" 
                                            @click="confirmDelete('deleteMappingForm-{{ $mapping->id }}', {{ $mapping->paslon_number }})"
                                            class="p-2 rounded-xl bg-white/10 hover:bg-rose-600 text-white font-bold transition border border-white/20 shadow-sm"
                                            title="Hapus Kartu Paslon">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="p-6 space-y-6">

                                <!-- DROPPABLE SLOTS GRID (KETUA & WAKIL KETUA) -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    
                                    <!-- KETUA DROP SLOT -->
                                    <div class="space-y-2">
                                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center justify-between">
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-[#1E5BB8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                </svg>
                                                CALON KETUA {{ $activeOrg }}
                                            </span>
                                            <span class="text-[10px] text-[#1E5BB8] font-bold">Target Drag & Drop</span>
                                        </label>
                                        
                                        <div @dragover.prevent="isDragOverKetua = true"
                                             @dragleave.prevent="isDragOverKetua = false" 
                                             @drop.prevent="handleChairmanDrop($event)"
                                             class="p-4 rounded-2xl border-2 border-dashed transition-all duration-200 min-h-[120px] flex flex-col justify-center items-center text-center relative"
                                             :class="{
                                                'border-[#1E5BB8] bg-blue-100/70 scale-[1.02] shadow-lg': isDragOverKetua,
                                                'border-blue-400 bg-blue-50/50 shadow-sm': chairmanId && !isDragOverKetua,
                                                'border-slate-300 bg-[#F8FAFC] hover:border-[#1E5BB8] hover:bg-blue-50/20': !chairmanId && !isDragOverKetua
                                             }">
                                            
                                            <template x-if="chairmanId">
                                                <div class="w-full flex items-center justify-between gap-3">
                                                    <div class="flex items-center gap-3 text-left">
                                                        <div class="w-10 h-10 rounded-xl bg-[#1E5BB8] text-white font-black flex items-center justify-center text-sm shadow-md">
                                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h5 class="text-xs font-black text-slate-900" x-text="chairmanName"></h5>
                                                            <p class="text-[10px] text-[#1E5BB8] font-bold" x-text="chairmanReg + ' • ' + chairmanClass"></p>
                                                        </div>
                                                    </div>
                                                    <button type="button" @click="clearChairman()" class="text-slate-400 hover:text-rose-600 p-1.5 font-black text-xs bg-white rounded-lg border border-slate-200 shadow-sm transition" title="Lepas Ketua">
                                                        ✕ Lepas
                                                    </button>
                                                </div>
                                            </template>

                                            <template x-if="!chairmanId">
                                                <div class="space-y-1.5">
                                                    <div class="w-10 h-10 rounded-2xl bg-blue-100 text-[#1E5BB8] flex items-center justify-center mx-auto shadow-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                    </div>
                                                    <p class="text-xs text-slate-700 font-black">Lepas kandidat ke sini sebagai <span class="text-[#1E5BB8]">Ketua</span></p>
                                                    <p class="text-[10px] text-slate-400 font-medium">Tarik kandidat dari daftar sebelah kiri</p>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- CUSTOM ALPINE.JS DROPDOWN MENU FOR KETUA -->
                                        <div class="relative mt-2">
                                            <button type="button" 
                                                    @click="openKetuaSelect = !openKetuaSelect; openWakilSelect = false" 
                                                    class="w-full py-2.5 px-3.5 bg-[#F8FAFC] hover:bg-slate-100 border border-slate-300 rounded-xl text-xs font-bold text-slate-800 flex items-center justify-between transition focus:outline-none focus:ring-4 focus:ring-blue-600/20 shadow-sm">
                                                <span x-text="chairmanName ? chairmanReg + ' - ' + chairmanName + ' (' + chairmanClass + ')' : '-- Pilih Dari Daftar Calon Ketua --'" class="truncate"></span>
                                                <svg class="w-4 h-4 text-slate-400 shrink-0 transition-transform duration-200" :class="openKetuaSelect ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown Options Menu Panel -->
                                            <div x-show="openKetuaSelect" 
                                                 @click.away="openKetuaSelect = false" 
                                                 x-cloak 
                                                 class="absolute left-0 right-0 mt-2 bg-white border border-slate-200 rounded-2xl shadow-xl z-30 py-2 max-h-60 overflow-y-auto text-xs font-semibold space-y-0.5 divide-y divide-slate-100 animate-fade-in">
                                                <div @click="clearChairman(); openKetuaSelect = false" 
                                                     class="px-4 py-2.5 hover:bg-rose-50 hover:text-rose-700 text-slate-500 font-bold cursor-pointer transition flex items-center justify-between">
                                                    <span>-- Kosongkan Pilihan Ketua --</span>
                                                </div>
                                                @foreach($candidates as $c)
                                                    @php
                                                        $cId = (string)$c->id;
                                                    @endphp
                                                    <div @click="
                                                            if (!isCandidateAssigned('{{ $cId }}') || String(chairmanId) === '{{ $cId }}') {
                                                                setSlotAssignment('c_{{ $mapping->id }}', '{{ $cId }}');
                                                                chairmanId = '{{ $cId }}';
                                                                chairmanName = '{{ addslashes($c->full_name) }}';
                                                                chairmanClass = '{{ addslashes($c->class_name) }}';
                                                                chairmanReg = '{{ $c->registration_number }}';
                                                                openKetuaSelect = false;
                                                            }
                                                         "
                                                         class="px-4 py-2.5 transition flex items-center justify-between gap-2"
                                                         :class="[
                                                            String(chairmanId) === '{{ $cId }}' ? 'bg-blue-50/80 text-[#1E5BB8] font-black' : '',
                                                            (isCandidateAssigned('{{ $cId }}') && String(chairmanId) !== '{{ $cId }}') 
                                                                ? 'opacity-40 bg-slate-50 cursor-not-allowed select-none' 
                                                                : 'hover:bg-blue-50 hover:text-[#1E5BB8] cursor-pointer text-slate-800'
                                                         ]">
                                                        <div class="flex items-center gap-2.5 min-w-0">
                                                            <div class="w-6 h-6 rounded-lg bg-blue-100 text-[#1E5BB8] flex items-center justify-center text-[10px] font-black shrink-0">
                                                                {{ substr($c->full_name, 0, 1) }}
                                                            </div>
                                                            <div class="truncate">
                                                                <span class="font-black text-slate-900 block truncate">{{ $c->full_name }}</span>
                                                                <span class="text-[10px] text-slate-500 font-medium block truncate">{{ $c->registration_number }} • {{ $c->class_name }}</span>
                                                            </div>
                                                        </div>

                                                        <template x-if="String(chairmanId) === '{{ $cId }}'">
                                                            <span class="text-xs font-black text-[#1E5BB8] shrink-0">✓</span>
                                                        </template>
                                                        <template x-if="isCandidateAssigned('{{ $cId }}') && String(chairmanId) !== '{{ $cId }}'">
                                                            <span class="text-[10px] font-extrabold text-slate-400 shrink-0">(Sudah Dipetakan)</span>
                                                        </template>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- WAKIL KETUA DROP SLOT -->
                                    <div class="space-y-2">
                                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center justify-between">
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-[#1E5BB8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                                CALON WAKIL KETUA {{ $activeOrg }}
                                            </span>
                                            <span class="text-[10px] text-[#1E5BB8] font-bold">Target Drag & Drop</span>
                                        </label>
                                        
                                        <div @dragover.prevent="isDragOverWakil = true"
                                             @dragleave.prevent="isDragOverWakil = false" 
                                             @drop.prevent="handleViceDrop($event)"
                                             class="p-4 rounded-2xl border-2 border-dashed transition-all duration-200 min-h-[120px] flex flex-col justify-center items-center text-center relative"
                                             :class="{
                                                'border-[#1E5BB8] bg-blue-100/70 scale-[1.02] shadow-lg': isDragOverWakil,
                                                'border-sky-400 bg-sky-50/50 shadow-sm': viceChairmanId && !isDragOverWakil,
                                                'border-slate-300 bg-[#F8FAFC] hover:border-[#1E5BB8] hover:bg-blue-50/20': !viceChairmanId && !isDragOverWakil
                                             }">
                                            
                                            <template x-if="viceChairmanId">
                                                <div class="w-full flex items-center justify-between gap-3">
                                                    <div class="flex items-center gap-3 text-left">
                                                        <div class="w-10 h-10 rounded-xl bg-[#1E5BB8] text-white font-black flex items-center justify-center text-sm shadow-md">
                                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h5 class="text-xs font-black text-slate-900" x-text="viceChairmanName"></h5>
                                                            <p class="text-[10px] text-[#1E5BB8] font-bold" x-text="viceChairmanReg + ' • ' + viceChairmanClass"></p>
                                                        </div>
                                                    </div>
                                                    <button type="button" @click="clearVice()" class="text-slate-400 hover:text-rose-600 p-1.5 font-black text-xs bg-white rounded-lg border border-slate-200 shadow-sm transition" title="Lepas Wakil">
                                                        ✕ Lepas
                                                    </button>
                                                </div>
                                            </template>

                                            <template x-if="!viceChairmanId">
                                                <div class="space-y-1.5">
                                                    <div class="w-10 h-10 rounded-2xl bg-blue-100 text-[#1E5BB8] flex items-center justify-center mx-auto shadow-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                    </div>
                                                    <p class="text-xs text-slate-700 font-black">Lepas kandidat ke sini sebagai <span class="text-[#1E5BB8]">Wakil Ketua</span></p>
                                                    <p class="text-[10px] text-slate-400 font-medium">Tarik kandidat dari daftar sebelah kiri</p>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- CUSTOM ALPINE.JS DROPDOWN MENU FOR WAKIL KETUA -->
                                        <div class="relative mt-2">
                                            <button type="button" 
                                                    @click="openWakilSelect = !openWakilSelect; openKetuaSelect = false" 
                                                    class="w-full py-2.5 px-3.5 bg-[#F8FAFC] hover:bg-slate-100 border border-slate-300 rounded-xl text-xs font-bold text-slate-800 flex items-center justify-between transition focus:outline-none focus:ring-4 focus:ring-blue-600/20 shadow-sm">
                                                <span x-text="viceChairmanName ? viceChairmanReg + ' - ' + viceChairmanName + ' (' + viceChairmanClass + ')' : '-- Pilih Dari Daftar Calon Wakil --'" class="truncate"></span>
                                                <svg class="w-4 h-4 text-slate-400 shrink-0 transition-transform duration-200" :class="openWakilSelect ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown Options Menu Panel -->
                                            <div x-show="openWakilSelect" 
                                                 @click.away="openWakilSelect = false" 
                                                 x-cloak 
                                                 class="absolute left-0 right-0 mt-2 bg-white border border-slate-200 rounded-2xl shadow-xl z-30 py-2 max-h-60 overflow-y-auto text-xs font-semibold space-y-0.5 divide-y divide-slate-100 animate-fade-in">
                                                <div @click="clearVice(); openWakilSelect = false" 
                                                     class="px-4 py-2.5 hover:bg-rose-50 hover:text-rose-700 text-slate-500 font-bold cursor-pointer transition flex items-center justify-between">
                                                    <span>-- Kosongkan Pilihan Wakil --</span>
                                                </div>
                                                @foreach($candidates as $c)
                                                    @php
                                                        $cId = (string)$c->id;
                                                    @endphp
                                                    <div @click="
                                                            if (!isCandidateAssigned('{{ $cId }}') || String(viceChairmanId) === '{{ $cId }}') {
                                                                setSlotAssignment('v_{{ $mapping->id }}', '{{ $cId }}');
                                                                viceChairmanId = '{{ $cId }}';
                                                                viceChairmanName = '{{ addslashes($c->full_name) }}';
                                                                viceChairmanClass = '{{ addslashes($c->class_name) }}';
                                                                viceChairmanReg = '{{ $c->registration_number }}';
                                                                openWakilSelect = false;
                                                            }
                                                         "
                                                         class="px-4 py-2.5 transition flex items-center justify-between gap-2"
                                                         :class="[
                                                            String(viceChairmanId) === '{{ $cId }}' ? 'bg-blue-50/80 text-[#1E5BB8] font-black' : '',
                                                            (isCandidateAssigned('{{ $cId }}') && String(viceChairmanId) !== '{{ $cId }}') 
                                                                ? 'opacity-40 bg-slate-50 cursor-not-allowed select-none' 
                                                                : 'hover:bg-blue-50 hover:text-[#1E5BB8] cursor-pointer text-slate-800'
                                                         ]">
                                                        <div class="flex items-center gap-2.5 min-w-0">
                                                            <div class="w-6 h-6 rounded-lg bg-blue-100 text-[#1E5BB8] flex items-center justify-center text-[10px] font-black shrink-0">
                                                                {{ substr($c->full_name, 0, 1) }}
                                                            </div>
                                                            <div class="truncate">
                                                                <span class="font-black text-slate-900 block truncate">{{ $c->full_name }}</span>
                                                                <span class="text-[10px] text-slate-500 font-medium block truncate">{{ $c->registration_number }} • {{ $c->class_name }}</span>
                                                            </div>
                                                        </div>

                                                        <template x-if="String(viceChairmanId) === '{{ $cId }}'">
                                                            <span class="text-xs font-black text-[#1E5BB8] shrink-0">✓</span>
                                                        </template>
                                                        <template x-if="isCandidateAssigned('{{ $cId }}') && String(viceChairmanId) !== '{{ $cId }}'">
                                                            <span class="text-[10px] font-extrabold text-slate-400 shrink-0">(Sudah Dipetakan)</span>
                                                        </template>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- PHOTO UPLOAD & PREVIEW SECTION -->
                                <div class="space-y-2 border-t border-slate-100 pt-5">
                                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-[#1E5BB8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        UPLOAD FOTO PASLON NO. {{ $mapping->paslon_number }}
                                    </label>
                                    
                                    <div class="flex flex-col sm:flex-row items-center gap-4 p-4 rounded-2xl bg-[#F8FAFC] border border-slate-200">
                                        <!-- Photo Preview Box -->
                                        <div class="w-28 h-28 rounded-2xl border-2 border-slate-300 bg-white overflow-hidden shrink-0 flex items-center justify-center shadow-inner relative">
                                            <template x-if="photoPreview">
                                                <img :src="photoPreview" alt="Foto Paslon" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!photoPreview">
                                                <div class="text-center p-2 text-slate-400">
                                                    <svg class="w-8 h-8 mx-auto mb-1 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span class="text-[10px] font-bold block">Belum Ada Foto Paslon</span>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Upload Input Control -->
                                        <div class="space-y-2 grow w-full">
                                            <input type="file" 
                                                   name="photo" 
                                                   accept="image/png, image/jpeg, image/jpg, image/webp" 
                                                   @change="previewFile($event)"
                                                   class="block w-full text-xs text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-[#1E5BB8] file:text-white hover:file:bg-[#1A4F9C] file:cursor-pointer cursor-pointer border border-slate-300 rounded-xl bg-white p-1" />
                                            <p class="text-[10px] text-slate-500 font-medium">
                                                Format yang didukung: JPG, PNG, WEBP (maksimal 2 MB).
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- VISION & MISSION TEXTAREAS -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 border-t border-slate-100 pt-5">
                                    <div class="space-y-2">
                                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-[#1E5BB8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            VISI PASLON
                                        </label>
                                        <textarea name="vision" 
                                                  rows="3" 
                                                  placeholder="Tuliskan visi Paslon nomor urut {{ $mapping->paslon_number }}..." 
                                                  class="w-full p-3.5 bg-[#F8FAFC] border border-slate-300 rounded-2xl text-xs font-semibold text-slate-900 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition">{{ old('vision', $mapping->vision) }}</textarea>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-[#1E5BB8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            MISI PASLON
                                        </label>
                                        <textarea name="mission" 
                                                  rows="3" 
                                                  placeholder="Tuliskan poin-poin misi Paslon nomor urut {{ $mapping->paslon_number }}..." 
                                                  class="w-full p-3.5 bg-[#F8FAFC] border border-slate-300 rounded-2xl text-xs font-semibold text-slate-900 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition">{{ old('mission', $mapping->mission) }}</textarea>
                                    </div>
                                </div>

                                <!-- Form Action Footer -->
                                <div class="flex items-center justify-end border-t border-slate-100 pt-4">
                                    <button type="submit" 
                                            class="px-6 py-3 bg-[#1E5BB8] hover:bg-[#1A4F9C] active:bg-[#153F7C] text-white text-xs font-black rounded-xl shadow-md shadow-blue-700/20 transition flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Simpan Paslon No. {{ $mapping->paslon_number }}</span>
                                    </button>
                                </div>

                            </div>
                        </form>

                        <!-- Hidden form for deleting card -->
                        <form id="deleteMappingForm-{{ $mapping->id }}" method="POST" action="{{ route('penerimaan.mapping.destroy', $mapping) }}" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endforeach

            </div>

        </div>

        <!-- DELETE CONFIRMATION MODAL -->
        <div x-show="deleteModal.open" 
             x-cloak 
             class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="deleteModal.open = false" 
                 class="bg-white border border-slate-200 rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl space-y-6 text-center animate-scale-up">
                
                <div class="w-16 h-16 rounded-2xl bg-rose-100 text-rose-600 border border-rose-300 flex items-center justify-center mx-auto shadow-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>

                <div>
                    <h3 class="text-xl font-black text-slate-900" x-text="deleteModal.title"></h3>
                    <p class="text-xs sm:text-sm text-slate-600 font-medium mt-2 leading-relaxed">
                        Apakah Anda yakin ingin menghapus kartu pemetaan pasangan calon ini?
                    </p>
                </div>

                <div class="flex items-center justify-center gap-3 pt-2">
                    <button type="button" @click="deleteModal.open = false" class="w-1/2 py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-extrabold rounded-xl transition">
                        Batal
                    </button>
                    <button type="button" @click="submitDelete()" class="w-1/2 py-3 px-4 bg-rose-600 hover:bg-rose-700 text-white text-xs font-black rounded-xl shadow-lg transition">
                        Ya, Hapus Paslon
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
