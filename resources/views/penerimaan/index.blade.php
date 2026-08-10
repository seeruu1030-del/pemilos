<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col justify-center min-w-0">
            <div class="flex items-center gap-2.5 min-w-0">
                <h2 class="font-black text-base sm:text-lg md:text-xl text-white tracking-tight leading-snug truncate">
                    Penerimaan Calon OSIS & MPK
                </h2>
                <span class="text-[10px] sm:text-xs font-black px-2.5 py-0.5 rounded-full bg-white/20 text-white border border-white/30 tracking-wide shrink-0">
                    Periode 2026/2027
                </span>
            </div>
            <p class="text-[10px] sm:text-xs text-sky-200 font-semibold truncate leading-tight mt-0.5">
                GAMANANTHA ANVAYA • Panel Seleksi Administrator (Role: Admin-02)
            </p>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6 sm:space-y-8" 
         x-data="{ 
            openOrgFilter: false,
            openStatusFilter: false,
            selectedOrgLabel: '{{ request('organization') ? request('organization') . ' Saja' : 'Semua Organisasi (OSIS & MPK)' }}',
            selectedStatusLabel: '{{ request('status') == 'pending' ? 'Dalam Seleksi (Pending)' : (request('status') == 'passed' ? 'Diterima (Lolos)' : (request('status') == 'failed' ? 'Tidak Lolos' : 'Semua Status Seleksi')) }}',
            
            // CUSTOM CONFIRMATION MODAL STATE
            confirmModal: {
                open: false,
                title: '',
                message: '',
                targetFormId: null,
                confirmText: 'Ya, Lanjutkan',
                type: 'emerald'
            },
            openConfirm(formId, title, message, confirmText, type) {
                this.confirmModal.targetFormId = formId;
                this.confirmModal.title = title;
                this.confirmModal.message = message;
                this.confirmModal.confirmText = confirmText;
                this.confirmModal.type = type;
                this.confirmModal.open = true;
            },
            submitConfirmedForm() {
                if (this.confirmModal.targetFormId) {
                    document.getElementById(this.confirmModal.targetFormId).submit();
                }
                this.confirmModal.open = false;
            }
         }">

        {{-- Alert Flash Success Message --}}
        @if (session('success'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-transition:leave="transition ease-in duration-200" 
                 x-transition:leave-start="opacity-100 scale-100" 
                 x-transition:leave-end="opacity-0 scale-95" 
                 class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200/90 text-emerald-950 text-xs sm:text-sm flex items-center justify-between shadow-sm animate-fade-in relative">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 font-extrabold shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="font-extrabold text-emerald-900 leading-snug truncate sm:whitespace-normal">{{ session('success') }}</span>
                </div>
                <button @click="show = false" type="button" class="p-1.5 rounded-lg text-emerald-700 hover:text-emerald-950 hover:bg-emerald-200/60 transition shrink-0 ml-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- DAPODIK KEMENDIKDASMEN STYLE: "OSKA Dalam Angka" SECTION --}}
        <div class="space-y-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100/80 text-blue-900 text-xs font-extrabold mb-1.5 border border-blue-200">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    Progres Pendaftaran
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">OSKA 2026/2027 dalam Angka</h3>
                <p class="text-xs text-slate-500 font-medium">Ringkasan Data Pokok Penerimaan Calon OSIS & MPK GAMANANTHA ANVAYA</p>
            </div>

            {{-- Dapodik Stat Cards Grid (Spacious & Clean Layout) --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                
                {{-- Total Calon Card --}}
                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-black text-slate-400 uppercase tracking-wider">TOTAL CALON</span>
                        <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0 border border-blue-100 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-black text-slate-900">{{ $stats['total'] }}</p>
                        <span class="text-xs text-slate-500 font-semibold mt-0.5 block">Pendaftar Masuk</span>
                    </div>
                </div>

                {{-- Calon OSIS Card --}}
                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-black text-sky-600 uppercase tracking-wider">CALON OSIS</span>
                        <div class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0 border border-sky-100 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-black text-sky-950">{{ $stats['osis'] }}</p>
                        <span class="text-xs text-sky-600 font-semibold mt-0.5 block">Pilihan OSIS</span>
                    </div>
                </div>

                {{-- Calon MPK Card --}}
                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-black text-purple-600 uppercase tracking-wider">CALON MPK</span>
                        <div class="w-10 h-10 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 border border-purple-100 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-black text-purple-950">{{ $stats['mpk'] }}</p>
                        <span class="text-xs text-purple-600 font-semibold mt-0.5 block">Pilihan MPK</span>
                    </div>
                </div>

                {{-- Diterima Card --}}
                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-black text-emerald-600 uppercase tracking-wider">DITERIMA</span>
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-black text-emerald-950">{{ $stats['passed'] }}</p>
                        <span class="text-xs text-emerald-600 font-bold mt-0.5 block">Pengumuman Lolos</span>
                    </div>
                </div>

                {{-- Tidak Lolos Card --}}
                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-black text-rose-600 uppercase tracking-wider">TIDAK LOLOS</span>
                        <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 border border-rose-100 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-black text-rose-950">{{ $stats['failed'] }}</p>
                        <span class="text-xs text-rose-600 font-bold mt-0.5 block">Gagal Seleksi</span>
                    </div>
                </div>

            </div>
        </div>



        {{-- MAIN DATA TABLE CARD (DAPODIK THEME) --}}
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
            
            <!-- Toolbar & Filter Controls -->
            <div class="p-6 border-b border-slate-200/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <form id="filterForm" method="GET" action="{{ route('penerimaan.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    
                    <input type="hidden" name="organization" id="inputOrganization" value="{{ request('organization') }}">
                    <input type="hidden" name="status" id="inputStatus" value="{{ request('status') }}">

                    <!-- Search Box (Dapodik Pill Search Input) -->
                    <div class="relative min-w-[240px] grow">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari sekolah, nama, no reg..." 
                               class="w-full pl-10 pr-4 py-2.5 bg-[#F8FAFC] border border-slate-300 rounded-xl text-xs font-semibold text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <!-- CUSTOM ALPINE.JS DROPDOWN: ORGANISASI FILTER -->
                    <div class="relative">
                        <button type="button" 
                                @click="openOrgFilter = !openOrgFilter; openStatusFilter = false" 
                                class="py-2.5 px-4 bg-[#F8FAFC] hover:bg-slate-100 border border-slate-300 rounded-xl text-xs font-extrabold text-slate-700 flex items-center gap-2 transition focus:outline-none focus:ring-4 focus:ring-blue-600/20">
                            <span x-text="selectedOrgLabel"></span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="openOrgFilter ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="openOrgFilter" 
                             @click.away="openOrgFilter = false" 
                             x-cloak 
                             class="absolute left-0 mt-2 w-56 bg-white border border-slate-200 rounded-2xl shadow-xl z-30 py-2 text-xs font-bold space-y-1 animate-fade-in">
                            <a href="#" @click.prevent="document.getElementById('inputOrganization').value = ''; document.getElementById('filterForm').submit()" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 text-slate-700 font-semibold">Semua Organisasi (OSIS & MPK)</a>
                            <a href="#" @click.prevent="document.getElementById('inputOrganization').value = 'OSIS'; document.getElementById('filterForm').submit()" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 text-slate-700 font-semibold">OSIS Saja</a>
                            <a href="#" @click.prevent="document.getElementById('inputOrganization').value = 'MPK'; document.getElementById('filterForm').submit()" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 text-slate-700 font-semibold">MPK Saja</a>
                        </div>
                    </div>

                    <!-- CUSTOM ALPINE.JS DROPDOWN: STATUS FILTER -->
                    <div class="relative">
                        <button type="button" 
                                @click="openStatusFilter = !openStatusFilter; openOrgFilter = false" 
                                class="py-2.5 px-4 bg-[#F8FAFC] hover:bg-slate-100 border border-slate-300 rounded-xl text-xs font-extrabold text-slate-700 flex items-center gap-2 transition focus:outline-none focus:ring-4 focus:ring-blue-600/20">
                            <span x-text="selectedStatusLabel"></span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="openStatusFilter ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="openStatusFilter" 
                             @click.away="openStatusFilter = false" 
                             x-cloak 
                             class="absolute left-0 mt-2 w-56 bg-white border border-slate-200 rounded-2xl shadow-xl z-30 py-2 text-xs font-bold space-y-1 animate-fade-in">
                            <a href="#" @click.prevent="document.getElementById('inputStatus').value = ''; document.getElementById('filterForm').submit()" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 text-slate-700 font-semibold">Semua Status Seleksi</a>
                            <a href="#" @click.prevent="document.getElementById('inputStatus').value = 'pending'; document.getElementById('filterForm').submit()" class="block px-4 py-2 hover:bg-amber-50 hover:text-amber-700 text-slate-700 font-semibold">Dalam Seleksi (Pending)</a>
                            <a href="#" @click.prevent="document.getElementById('inputStatus').value = 'passed'; document.getElementById('filterForm').submit()" class="block px-4 py-2 hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 font-semibold">Diterima (Lolos)</a>
                            <a href="#" @click.prevent="document.getElementById('inputStatus').value = 'failed'; document.getElementById('filterForm').submit()" class="block px-4 py-2 hover:bg-rose-50 hover:text-rose-700 text-slate-700 font-semibold">Tidak Lolos</a>
                        </div>
                    </div>

                    @if(request()->anyFilled(['search', 'organization', 'status']))
                        <a href="{{ route('penerimaan.index') }}" class="text-xs text-rose-600 hover:underline font-bold px-2">Reset Filter</a>
                    @endif
                </form>

                <!-- Dedicated Page Navigation Button for Adding Candidate -->
                <a href="{{ route('penerimaan.create') }}" 
                   class="px-5 py-2.5 bg-[#1E5BB8] hover:bg-[#1A4F9C] active:bg-[#153F7C] text-white font-black text-xs rounded-xl shadow-md shadow-blue-700/20 transition flex items-center justify-center gap-2 shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Tambah Calon OSIS / MPK</span>
                </a>
            </div>

            <!-- Table Data Calon (Dapodik Kemendikdasmen Style) -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[850px]">
                    <thead>
                        <tr class="bg-[#EFF4FA] border-b border-slate-200 text-[11px] font-black text-[#1E4D8C] uppercase tracking-wider whitespace-nowrap">
                            <th class="py-4 px-5">No. Reg</th>
                            <th class="py-4 px-5">Nama Lengkap</th>
                            <th class="py-4 px-5">Tempat, Tgl Lahir</th>
                            <th class="py-4 px-5 text-center">L/P</th>
                            <th class="py-4 px-5">Kelas</th>
                            <th class="py-4 px-5">Organisasi</th>
                            <th class="py-4 px-5">Status Seleksi</th>
                            <th class="py-4 px-5 text-center">Keputusan / Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/80 text-xs font-medium">
                        @forelse($candidates as $candidate)
                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="py-4 px-5 font-mono font-black text-blue-800 whitespace-nowrap">
                                    {{ $candidate->registration_number }}
                                </td>
                                <td class="py-4 px-5 font-black text-slate-900">
                                    {{ $candidate->full_name }}
                                    @if($candidate->notes)
                                        <p class="text-[10px] text-slate-400 font-medium mt-0.5 italic max-w-xs truncate" title="{{ $candidate->notes }}">
                                            "{{ $candidate->notes }}"
                                        </p>
                                    @endif
                                </td>
                                <td class="py-4 px-5 text-slate-600 font-semibold whitespace-nowrap">
                                    {{ $candidate->birth_place }}, {{ $candidate->birth_date->format('d/m/Y') }}
                                </td>
                                <td class="py-4 px-5 font-bold text-center whitespace-nowrap">
                                    <span class="px-3 py-1 rounded-lg text-[11px] font-black whitespace-nowrap inline-block {{ $candidate->gender == 'Laki-laki' ? 'bg-blue-100 text-blue-900' : 'bg-pink-100 text-pink-900' }}">
                                        {{ $candidate->gender }}
                                    </span>
                                </td>
                                <td class="py-4 px-5 font-black text-slate-800 whitespace-nowrap">
                                    {{ $candidate->class_name }}
                                </td>
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <span class="px-3 py-1 rounded-lg text-[11px] font-black {{ $candidate->organization_type == 'OSIS' ? 'bg-blue-700 text-white shadow-sm' : 'bg-purple-700 text-white shadow-sm' }}">
                                        {{ $candidate->organization_type }}
                                    </span>
                                </td>
                                <td class="py-4 px-5 whitespace-nowrap">
                                    @if($candidate->isPassed())
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-900 border border-emerald-300 text-[11px] font-black">
                                            <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                                            Diterima (Lolos)
                                        </span>
                                    @elseif($candidate->isFailed())
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-100 text-rose-900 border border-rose-300 text-[11px] font-black">
                                            <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                                            Tidak Lolos
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-900 border border-amber-300 text-[11px] font-black">
                                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                            Proses Seleksi
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <!-- Quick Decision Buttons with Custom Confirmation Modal -->
                                        @if(!$candidate->isPassed())
                                            <form id="passForm-{{ $candidate->id }}" method="POST" action="{{ route('penerimaan.updateStatus', $candidate) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="passed">
                                                <button type="button" 
                                                        @click="openConfirm('passForm-{{ $candidate->id }}', 'Konfirmasi Lolos Seleksi', 'Apakah Anda yakin ingin MELULUSKAN {{ $candidate->full_name }} sebagai calon pengurus {{ $candidate->organization_type }}?', 'Ya, Loloskan', 'emerald')" 
                                                        title="Setujui / Loloskan"
                                                        class="p-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold transition shadow-sm hover:scale-105">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif

                                        @if(!$candidate->isFailed())
                                            <form id="failForm-{{ $candidate->id }}" method="POST" action="{{ route('penerimaan.updateStatus', $candidate) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="failed">
                                                <button type="button" 
                                                        @click="openConfirm('failForm-{{ $candidate->id }}', 'Konfirmasi Tidak Lolos', 'Apakah Anda yakin menyatakan {{ $candidate->full_name }} TIDAK LOLOS seleksi {{ $candidate->organization_type }}?', 'Ya, Tidak Loloskan', 'rose')" 
                                                        title="Setujui / Tidak Loloskan"
                                                        class="p-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold transition shadow-sm hover:scale-105">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Dedicated Page Edit Link Button -->
                                        <a href="{{ route('penerimaan.edit', $candidate) }}" 
                                           title="Edit Data Calon (Buka Halaman Edit)" 
                                           class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold transition border border-slate-300 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Delete Form with Custom Confirmation Modal -->
                                        <form id="deleteForm-{{ $candidate->id }}" method="POST" action="{{ route('penerimaan.destroy', $candidate) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    @click="openConfirm('deleteForm-{{ $candidate->id }}', 'Konfirmasi Hapus Data', 'Apakah Anda yakin ingin menghapus data calon {{ $candidate->full_name }} secara permanen?', 'Ya, Hapus Data', 'rose')" 
                                                    title="Hapus" 
                                                    class="p-2 rounded-xl bg-slate-100 hover:bg-rose-100 hover:text-rose-600 text-slate-400 transition border border-slate-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-12 text-center text-slate-400 font-semibold">
                                    Belum ada data calon pengurus OSIS & MPK yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($candidates->hasPages())
                <div class="p-4 border-t border-slate-200">
                    {{ $candidates->links() }}
                </div>
            @endif

        </div>

        {{-- CUSTOM CONFIRMATION DIALOG MODAL --}}
        <div x-show="confirmModal.open" 
             x-cloak 
             class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="confirmModal.open = false" 
                 class="bg-white border border-slate-200 rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl space-y-6 text-center animate-scale-up">
                
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto shadow-lg"
                     :class="confirmModal.type === 'emerald' ? 'bg-emerald-100 text-emerald-600 border border-emerald-300' : 'bg-rose-100 text-rose-600 border border-rose-300'">
                    <template x-if="confirmModal.type === 'emerald'">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </template>
                    <template x-if="confirmModal.type === 'rose'">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </template>
                </div>

                <div>
                    <h3 class="text-xl font-black text-slate-900" x-text="confirmModal.title"></h3>
                    <p class="text-xs sm:text-sm text-slate-600 font-medium mt-2 leading-relaxed" x-text="confirmModal.message"></p>
                </div>

                <div class="flex items-center justify-center gap-3 pt-2">
                    <button type="button" 
                            @click="confirmModal.open = false" 
                            class="w-1/2 py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-extrabold rounded-xl transition">
                        Batal
                    </button>
                    <button type="button" 
                            @click="submitConfirmedForm()" 
                            :class="confirmModal.type === 'emerald' ? 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/30' : 'bg-rose-600 hover:bg-rose-700 shadow-rose-600/30'"
                            class="w-1/2 py-3 px-4 text-white text-xs font-black rounded-xl shadow-lg transition"
                            x-text="confirmModal.confirmText">
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
