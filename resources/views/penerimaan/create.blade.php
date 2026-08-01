<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3.5">
            <a href="{{ route('penerimaan.index') }}" 
               class="p-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/20 transition flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-white leading-tight">
                    Tambah Calon Pengurus Baru
                </h2>
                <p class="text-xs text-sky-200 font-medium mt-0.5">
                    Penerimaan Calon OSIS & MPK SMKS Nurul Islam Periode 2026/2027
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">
        
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden p-8 sm:p-10 space-y-8">
            
            {{-- Header Banner --}}
            <div class="flex items-center gap-4 border-b border-slate-100 pb-6">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-[#1E5BB8] to-[#1A4F9C] text-white flex items-center justify-center font-black text-xl shadow-lg shadow-blue-700/20">
                    +
                </div>
                <div>
                    <h3 class="text-lg font-black text-slate-900">Formulir Pendaftaran Calon</h3>
                    <p class="text-xs text-slate-500 font-medium">Lengkapi seluruh data identitas calon di bawah ini dengan benar.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('penerimaan.store') }}" class="space-y-6" 
                  x-data="{ 
                      org: '{{ old('organization_type', 'OSIS') }}',
                      gender: '{{ old('gender', 'Laki-laki') }}',
                      status: '{{ old('status', 'pending') }}',
                      openStatusDrop: false
                  }">
                @csrf

                {{-- Organisasi Toggle Pills --}}
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">
                        Pilihan Organisasi *
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <label @click="org = 'OSIS'" 
                               :class="org === 'OSIS' ? 'bg-[#1E5BB8] text-white border-[#1E5BB8] shadow-lg shadow-blue-700/20' : 'bg-slate-50 text-slate-700 border-slate-300 hover:bg-slate-100'"
                               class="flex items-center justify-center gap-2 p-4 rounded-2xl border font-black text-sm cursor-pointer transition">
                            <input type="radio" name="organization_type" value="OSIS" x-model="org" class="sr-only">
                            <span class="w-2.5 h-2.5 rounded-full" :class="org === 'OSIS' ? 'bg-white' : 'bg-[#1E5BB8]'"></span>
                            <span>CALON OSIS</span>
                        </label>

                        <label @click="org = 'MPK'" 
                               :class="org === 'MPK' ? 'bg-purple-700 text-white border-purple-700 shadow-lg shadow-purple-700/20' : 'bg-slate-50 text-slate-700 border-slate-300 hover:bg-slate-100'"
                               class="flex items-center justify-center gap-2 p-4 rounded-2xl border font-black text-sm cursor-pointer transition">
                            <input type="radio" name="organization_type" value="MPK" x-model="org" class="sr-only">
                            <span class="w-2.5 h-2.5 rounded-full" :class="org === 'MPK' ? 'bg-white' : 'bg-purple-700'"></span>
                            <span>CALON MPK</span>
                        </label>
                    </div>
                </div>

                {{-- Nama Lengkap Calon --}}
                <div>
                    <label for="full_name" class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">
                        Nama Lengkap Calon *
                    </label>
                    <input type="text" 
                           id="full_name" 
                           name="full_name" 
                           value="{{ old('full_name') }}" 
                           required 
                           autofocus
                           placeholder="Contoh: Ahmad Fauzi" 
                           class="w-full py-3.5 px-4 bg-slate-50 border border-slate-300 rounded-xl text-sm font-semibold text-slate-900 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                    @error('full_name')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tempat & Tanggal Lahir --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="birth_place" class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">
                            Tempat Lahir *
                        </label>
                        <input type="text" 
                               id="birth_place" 
                               name="birth_place" 
                               value="{{ old('birth_place') }}" 
                               required 
                               placeholder="Contoh: Jakarta" 
                               class="w-full py-3.5 px-4 bg-slate-50 border border-slate-300 rounded-xl text-sm font-semibold text-slate-900 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                        @error('birth_place')
                            <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">
                            Tanggal Lahir (Tanggal / Bulan / Tahun) *
                        </label>
                        <div class="flex items-center gap-2">
                            {{-- Tanggal --}}
                            <div class="w-1/3">
                                <input type="number" 
                                       name="birth_day" 
                                       inputmode="numeric"
                                       min="1" 
                                       max="31" 
                                       value="{{ old('birth_day') }}" 
                                       required 
                                       placeholder="Tanggal (DD)" 
                                       class="w-full py-3.5 px-3 bg-slate-50 border border-slate-300 rounded-xl text-center text-sm font-semibold text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                            </div>

                            <span class="text-slate-400 font-bold text-lg">/</span>

                            {{-- Bulan --}}
                            <div class="w-1/3">
                                <input type="number" 
                                       name="birth_month" 
                                       inputmode="numeric"
                                       min="1" 
                                       max="12" 
                                       value="{{ old('birth_month') }}" 
                                       required 
                                       placeholder="Bulan (MM)" 
                                       class="w-full py-3.5 px-3 bg-slate-50 border border-slate-300 rounded-xl text-center text-sm font-semibold text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                            </div>

                            <span class="text-slate-400 font-bold text-lg">/</span>

                            {{-- Tahun --}}
                            <div class="w-1/3">
                                <input type="number" 
                                       name="birth_year" 
                                       inputmode="numeric"
                                       min="1990" 
                                       max="2026" 
                                       value="{{ old('birth_year') }}" 
                                       required 
                                       placeholder="Tahun (YYYY)" 
                                       class="w-full py-3.5 px-3 bg-slate-50 border border-slate-300 rounded-xl text-center text-sm font-semibold text-slate-900 placeholder-slate-400 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                            </div>
                        </div>
                        @error('birth_date')
                            <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Jenis Kelamin (Custom Pill Selector) & Kelas --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    {{-- Jenis Kelamin (Custom Pill Selector) --}}
                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">
                            Jenis Kelamin *
                        </label>
                        <input type="hidden" name="gender" :value="gender">
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" 
                                    @click="gender = 'Laki-laki'" 
                                    :class="gender === 'Laki-laki' ? 'bg-blue-50 text-blue-800 border-blue-500 font-black shadow-sm' : 'bg-slate-50 text-slate-600 border-slate-300 hover:bg-slate-100 font-semibold'"
                                    class="py-3.5 px-3 rounded-xl border text-xs flex items-center justify-center gap-1.5 transition">
                                <span>Laki-laki</span>
                            </button>
                            <button type="button" 
                                    @click="gender = 'Perempuan'" 
                                    :class="gender === 'Perempuan' ? 'bg-pink-50 text-pink-800 border-pink-500 font-black shadow-sm' : 'bg-slate-50 text-slate-600 border-slate-300 hover:bg-slate-100 font-semibold'"
                                    class="py-3.5 px-3 rounded-xl border text-xs flex items-center justify-center gap-1.5 transition">
                                <span>Perempuan</span>
                            </button>
                        </div>
                    </div>

                    {{-- Kelas --}}
                    <div>
                        <label for="class_name" class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">
                            Kelas *
                        </label>
                        <input type="text" 
                               id="class_name" 
                               name="class_name" 
                               value="{{ old('class_name') }}" 
                               required 
                               placeholder="Contoh: X TKJ 1" 
                               class="w-full py-3.5 px-4 bg-slate-50 border border-slate-300 rounded-xl text-sm font-semibold text-slate-900 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition" />
                        @error('class_name')
                            <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Status Seleksi Awal (CUSTOM ALPINE.JS DROPDOWN CARD) --}}
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">
                        Status Seleksi Awal *
                    </label>
                    <input type="hidden" name="status" :value="status">
                    
                    <div class="relative">
                        <button type="button" 
                                @click="openStatusDrop = !openStatusDrop" 
                                class="w-full py-3.5 px-4 bg-slate-50 hover:bg-slate-100 border border-slate-300 rounded-xl text-sm font-black text-slate-900 flex items-center justify-between transition focus:outline-none focus:ring-4 focus:ring-blue-600/20">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full" 
                                      :class="status === 'passed' ? 'bg-emerald-500' : (status === 'failed' ? 'bg-rose-500' : 'bg-amber-500')"></span>
                                <span x-text="status === 'passed' ? 'Diterima (Lolos Seleksi)' : (status === 'failed' ? 'Tidak Lolos' : 'Dalam Seleksi (Pending)')"></span>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 transition-transform duration-200" :class="openStatusDrop ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Floating Custom Dropdown Card --}}
                        <div x-show="openStatusDrop" 
                             @click.away="openStatusDrop = false" 
                             x-cloak 
                             class="absolute left-0 right-0 mt-2 bg-white border border-slate-200 rounded-2xl shadow-xl z-30 p-2 text-xs font-bold space-y-1 animate-fade-in">
                            
                            <div @click="status = 'pending'; openStatusDrop = false" 
                                 :class="status === 'pending' ? 'bg-amber-50 text-amber-900 font-black' : 'text-slate-700 hover:bg-slate-50'"
                                 class="p-3 rounded-xl cursor-pointer flex items-center justify-between transition">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                    <span>Dalam Seleksi (Pending)</span>
                                </div>
                                <span x-show="status === 'pending'" class="text-amber-600 font-bold">✓</span>
                            </div>

                            <div @click="status = 'passed'; openStatusDrop = false" 
                                 :class="status === 'passed' ? 'bg-emerald-50 text-emerald-900 font-black' : 'text-slate-700 hover:bg-slate-50'"
                                 class="p-3 rounded-xl cursor-pointer flex items-center justify-between transition">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                    <span>Diterima (Lolos Seleksi)</span>
                                </div>
                                <span x-show="status === 'passed'" class="text-emerald-600 font-bold">✓</span>
                            </div>

                            <div @click="status = 'failed'; openStatusDrop = false" 
                                 :class="status === 'failed' ? 'bg-rose-50 text-rose-900 font-black' : 'text-slate-700 hover:bg-slate-50'"
                                 class="p-3 rounded-xl cursor-pointer flex items-center justify-between transition">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                                    <span>Tidak Lolos</span>
                                </div>
                                <span x-show="status === 'failed'" class="text-rose-600 font-bold">✓</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Catatan Panitia --}}
                <div>
                    <label for="notes" class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">
                        Catatan Panitia (Opsional)
                    </label>
                    <textarea id="notes" 
                              name="notes" 
                              rows="3" 
                              placeholder="Catatan hasil wawancara, prestasi, atau berkas..." 
                              class="w-full py-3.5 px-4 bg-slate-50 border border-slate-300 rounded-xl text-sm font-semibold text-slate-900 focus:border-[#1E5BB8] focus:bg-white focus:ring-4 focus:ring-blue-600/20 focus:outline-none transition">{{ old('notes') }}</textarea>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-6 flex items-center justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('penerimaan.index') }}" 
                       class="px-6 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-extrabold rounded-xl transition">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-8 py-3.5 bg-[#1E5BB8] hover:bg-[#1A4F9C] active:bg-[#153F7C] text-white text-xs font-black tracking-wider rounded-xl shadow-lg shadow-blue-700/20 hover:shadow-blue-700/30 transition">
                        Simpan Pendaftaran Calon
                    </button>
                </div>

            </form>

        </div>

    </div>
</x-app-layout>
