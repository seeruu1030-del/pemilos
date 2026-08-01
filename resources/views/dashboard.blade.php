<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-100 leading-tight">
                {{ __('Dashboard Administrator') }}
            </h2>
            <div class="flex items-center gap-2">
                @if(Auth::user()->isAdminPemilos())
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-500/10 border border-indigo-500/30 text-indigo-600 dark:text-indigo-400">
                        Role: ADMIN-01 (PEMILOS)
                    </span>
                @elseif(Auth::user()->isAdminPenerimaan())
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-500/10 border border-purple-500/30 text-purple-600 dark:text-purple-400">
                        Role: ADMIN-02 (PENERIMAAN)
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-500/10 border border-slate-500/30 text-slate-600 dark:text-slate-400">
                        Role: {{ Auth::user()->role }}
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Banner Card -->
            <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white rounded-2xl p-8 shadow-xl border border-slate-800">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="space-y-2">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Sesi Otentikasi Aktif
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                            Selamat Datang, {{ Auth::user()->name }}! 👋
                        </h3>
                        <p class="text-slate-300 text-sm">
                            Username: <code class="px-2 py-0.5 rounded bg-slate-800 text-indigo-300 font-mono">{{ Auth::user()->username }}</code> 
                            | Hak Akses: <strong class="text-indigo-400">{{ Auth::user()->role_label }}</strong>
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="px-4 py-3 rounded-xl bg-slate-800/80 border border-slate-700 text-center">
                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Status Keamanan</p>
                            <p class="text-sm font-extrabold text-emerald-400">Terproteksi SSL</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role Specific Panel Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card Pemilos -->
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-500 flex items-center justify-center font-bold text-xl">
                            01
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900 dark:text-white">Modul Pemilos (Admin-01)</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Pengelolaan DPT, Paslon & E-Voting</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
                        Hak akses khusus untuk panitia dan administrator Pemilihan Ketua OSIS.
                    </p>
                    @if(Auth::user()->isAdminPemilos())
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-500 text-white text-xs font-semibold shadow-sm">
                            ✓ Akses Diizinkan
                        </div>
                    @else
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-400 text-xs font-semibold">
                            🔒 Terkunci (Perlu Role Admin-01)
                        </div>
                    @endif
                </div>

                <!-- Card Penerimaan -->
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-500 flex items-center justify-center font-bold text-xl">
                            02
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900 dark:text-white">Modul Penerimaan (Admin-02)</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Pendaftaran & Seleksi Siswa Baru</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
                        Hak akses khusus untuk panitia penerimaan siswa baru dan verifikasi berkas.
                    </p>
                    @if(Auth::user()->isAdminPenerimaan())
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-purple-500 text-white text-xs font-semibold shadow-sm">
                            ✓ Akses Diizinkan
                        </div>
                    @else
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-400 text-xs font-semibold">
                            🔒 Terkunci (Perlu Role Admin-02)
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
