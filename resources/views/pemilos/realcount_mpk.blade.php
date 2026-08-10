<x-pemilos-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 28s linear infinite;
        }
    </style>

    <div class="min-h-[calc(100vh-5rem)] bg-[#F1F5F9] text-slate-800 p-3 sm:p-5 selection:bg-amber-600 selection:text-white flex flex-col justify-between"
         x-data="{
             activeTab: 'realcount', // 'realcount', 'showcase', or 'guide'
             isFullscreen: false,
             mappings: [],
             totalVotes: 0,
             displayTotalVotes: 0,
             lastUpdated: '-',
             isLoading: true,
             leaderPaslon: null,
             timer: null,

             // Chart.js Instances
             doughnutChart: null,
             barChart: null,

             // 40-Second Auto Switch State
             autoSwitchEnabled: true,
             switchCountdown: 40,
             autoSwitchTimer: null,
             
             // Dynamic TV Colors for Paslon MPK
             paslonColors: [
                 { bg: 'bg-amber-600', text: 'text-amber-600', border: 'border-amber-600', hex: '#D97706', badgeBg: 'bg-amber-700' },
                 { bg: 'bg-blue-600', text: 'text-blue-600', border: 'border-blue-600', hex: '#2563EB', badgeBg: 'bg-blue-700' },
                 { bg: 'bg-red-600', text: 'text-red-600', border: 'border-red-600', hex: '#DC2626', badgeBg: 'bg-red-600' },
                 { bg: 'bg-emerald-600', text: 'text-emerald-600', border: 'border-emerald-600', hex: '#059669', badgeBg: 'bg-emerald-600' },
                 { bg: 'bg-purple-600', text: 'text-purple-600', border: 'border-purple-600', hex: '#7C3AED', badgeBg: 'bg-purple-600' }
             ],

             getColor(idx) {
                 return this.paslonColors[idx % this.paslonColors.length];
             },

             animateCount(start, end, duration, callback) {
                 if (start === end) {
                     callback(end);
                     return;
                 }
                 let range = end - start;
                 let current = start;
                 let increment = end > start ? 1 : -1;
                 let stepTime = Math.abs(Math.floor(duration / (range || 1)));
                 stepTime = Math.max(stepTime, 20);

                 let timer = setInterval(() => {
                     current += increment;
                     callback(current);
                     if (current === end) {
                         clearInterval(timer);
                     }
                 }, stepTime);
             },

             updateCharts() {
                 if (typeof Chart === 'undefined' || !this.mappings || this.mappings.length === 0) return;

                 let labels = this.mappings.map(m => 'Paslon MPK 0' + m.paslon_number + ' (' + m.chairman_name + ')');
                 let votes = this.mappings.map(m => m.votes_count);
                 let colors = this.mappings.map((m, idx) => this.getColor(idx).hex);

                 // 1. DOUGHNUT CHART UPDATE
                 const ctxDoughnut = document.getElementById('doughnutChartCanvasMpk');
                 if (ctxDoughnut) {
                     if (this.doughnutChart) {
                         this.doughnutChart.data.labels = labels;
                         this.doughnutChart.data.datasets[0].data = votes;
                         this.doughnutChart.data.datasets[0].backgroundColor = colors;
                         this.doughnutChart.update();
                     } else {
                         this.doughnutChart = new Chart(ctxDoughnut, {
                             type: 'doughnut',
                             data: {
                                 labels: labels,
                                 datasets: [{
                                     data: votes,
                                     backgroundColor: colors,
                                     borderWidth: 2,
                                     borderColor: '#ffffff'
                                 }]
                             },
                             options: {
                                 responsive: true,
                                 maintainAspectRatio: false,
                                 plugins: {
                                     legend: {
                                         position: 'bottom',
                                         labels: { font: { size: 11, weight: 'bold' }, padding: 12 }
                                     },
                                     tooltip: {
                                         callbacks: {
                                             label: (ctx) => {
                                                 let val = ctx.raw || 0;
                                                 let total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                                 let pct = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                                                 return ' ' + ctx.label + ': ' + val + ' Suara MPK (' + pct + '%)';
                                             }
                                         }
                                     }
                                 }
                             }
                         });
                     }
                 }

                 // 2. BAR CHART UPDATE
                 const ctxBar = document.getElementById('barChartCanvasMpk');
                 if (ctxBar) {
                     let barLabels = this.mappings.map(m => 'Paslon MPK 0' + m.paslon_number);
                     if (this.barChart) {
                         this.barChart.data.labels = barLabels;
                         this.barChart.data.datasets[0].data = votes;
                         this.barChart.data.datasets[0].backgroundColor = colors;
                         this.barChart.update();
                     } else {
                         this.barChart = new Chart(ctxBar, {
                             type: 'bar',
                             data: {
                                 labels: barLabels,
                                 datasets: [{
                                     label: 'Jumlah Suara MPK Sah',
                                     data: votes,
                                     backgroundColor: colors,
                                     borderRadius: 8,
                                     maxBarThickness: 48
                                 }]
                             },
                             options: {
                                 responsive: true,
                                 maintainAspectRatio: false,
                                 plugins: {
                                     legend: { display: false },
                                     tooltip: {
                                         callbacks: {
                                             label: (ctx) => {
                                                 let paslon = this.mappings[ctx.dataIndex];
                                                 return ' ' + paslon.chairman_name + ' & ' + paslon.vice_chairman_name + ': ' + ctx.raw + ' Suara MPK (' + paslon.percentage + '%)';
                                             }
                                         }
                                     }
                                 },
                                 scales: {
                                     y: {
                                         beginAtZero: true,
                                         ticks: { precision: 0, font: { weight: 'bold' } },
                                         grid: { color: '#F1F5F9' }
                                     },
                                     x: {
                                         ticks: { font: { weight: 'bold', size: 11 } },
                                         grid: { display: false }
                                     }
                                 }
                             }
                         });
                     }
                 }
             },

             fetchRealCount() {
                 fetch('{{ route('pemilos.mpk.realcount.data') }}')
                     .then(res => res.json())
                     .then(data => {
                         if (data.success) {
                             this.mappings = data.mappings;
                             this.totalVotes = data.total_votes;
                             
                             let now = new Date();
                             let hh = String(now.getHours()).padStart(2, '0');
                             let mm = String(now.getMinutes()).padStart(2, '0');
                             let ss = String(now.getSeconds()).padStart(2, '0');
                             this.lastUpdated = hh + ':' + mm + ':' + ss + ' WIB';
                             
                             this.isLoading = false;

                             this.animateCount(this.displayTotalVotes, data.total_votes, 800, (val) => {
                                 this.displayTotalVotes = val;
                             });
                             
                             if (data.mappings.length > 0) {
                                 let sorted = [...data.mappings].sort((a, b) => b.votes_count - a.votes_count);
                                 if (sorted[0].votes_count > 0) {
                                     this.leaderPaslon = sorted[0];
                                 } else {
                                     this.leaderPaslon = null;
                                 }
                             }

                             this.$nextTick(() => {
                                 if (this.activeTab === 'realcount') {
                                     this.updateCharts();
                                 }
                             });
                         }
                     })
                     .catch(err => console.error('RealCount MPK poll error:', err));
             },

             toggleFullscreen() {
                 if (!document.fullscreenElement) {
                     document.documentElement.requestFullscreen().then(() => {
                         this.isFullscreen = true;
                     }).catch(err => console.error(err));
                 } else {
                     if (document.exitFullscreen) {
                         document.exitFullscreen().then(() => {
                             this.isFullscreen = false;
                         });
                     }
                 }
             },

             switchTab(tab) {
                 this.activeTab = tab;
                 this.switchCountdown = 40;
                 if (tab === 'realcount') {
                     this.$nextTick(() => {
                         this.updateCharts();
                     });
                 }
             },

             init() {
                 this.fetchRealCount();
                 this.timer = setInterval(() => {
                     this.fetchRealCount();
                 }, 3000);

                 // 40-Second Auto Switch Timer Cycling for MPK: realcount -> showcase -> guide -> realcount
                 this.autoSwitchTimer = setInterval(() => {
                     if (this.autoSwitchEnabled) {
                         this.switchCountdown--;
                         if (this.switchCountdown <= 0) {
                             if (this.activeTab === 'realcount') {
                                 this.switchTab('showcase');
                             } else if (this.activeTab === 'showcase') {
                                 this.switchTab('guide');
                             } else {
                                 this.switchTab('realcount');
                             }
                             this.switchCountdown = 40;
                         }
                     }
                 }, 1000);

                 document.addEventListener('fullscreenchange', () => {
                     this.isFullscreen = !!document.fullscreenElement;
                 });
             },

             destroy() {
                 if (this.timer) clearInterval(this.timer);
                 if (this.autoSwitchTimer) clearInterval(this.autoSwitchTimer);
                 if (this.doughnutChart) this.doughnutChart.destroy();
                 if (this.barChart) this.barChart.destroy();
             }
         }">

        <!-- TV NEWS BROADCAST TOP HEADER BAR FOR MPK -->
        <div class="mb-3 p-3 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                
                <!-- Left: Title & Status -->
                <div class="flex items-center gap-2.5 text-center sm:text-left">
                    <div class="w-9 h-9 rounded-xl bg-amber-600 text-white flex items-center justify-center font-black shadow-sm shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 justify-center sm:justify-start">
                            <span class="px-2 py-0.5 rounded bg-amber-600 text-white text-[9px] font-black uppercase tracking-widest flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span>
                                SIARAN PEMILOS MPK
                            </span>
                            <span class="text-xs font-bold text-slate-600">SMK NURUL ISLAM 2026/2027</span>
                        </div>
                        <h2 class="text-base font-black text-slate-900 tracking-tight leading-snug"
                            x-text="activeTab === 'realcount' ? 'HASIL PENGHITUNGAN SUARA MPK REALTIME & QUICK COUNT' : (activeTab === 'showcase' ? 'PROFIL & VISI MISI PASANGAN CALON MPK' : 'PANDUAN & ALUR TATA CARA E-VOTING MPK')">
                        </h2>
                    </div>
                </div>

                <!-- Middle: Page Switcher Buttons for MPK -->
                <div class="flex flex-wrap items-center justify-center gap-1.5 p-1 rounded-xl bg-slate-100 border border-slate-200 shrink-0">
                    <button @click="switchTab('realcount')" 
                            type="button"
                            :class="activeTab === 'realcount' ? 'bg-amber-600 text-white font-black shadow-sm' : 'text-slate-600 hover:text-slate-900 font-bold'"
                            class="px-3 py-1.5 rounded-lg text-xs transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Real Count MPK</span>
                    </button>

                    <button @click="switchTab('showcase')" 
                            type="button"
                            :class="activeTab === 'showcase' ? 'bg-amber-600 text-white font-black shadow-sm' : 'text-slate-600 hover:text-slate-900 font-bold'"
                            class="px-3 py-1.5 rounded-lg text-xs transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 01-2-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span>Profil Paslon MPK</span>
                    </button>

                    <button @click="switchTab('guide')" 
                            type="button"
                            :class="activeTab === 'guide' ? 'bg-amber-600 text-white font-black shadow-sm' : 'text-slate-600 hover:text-slate-900 font-bold'"
                            class="px-3 py-1.5 rounded-lg text-xs transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Panduan Pemilihan</span>
                    </button>

                    <button @click="autoSwitchEnabled = !autoSwitchEnabled"
                            type="button"
                            title="Klik untuk jeda / aktifkan rotasi otomatis 40 detik"
                            class="px-2 py-1 rounded-lg text-[10px] font-black tracking-wide border transition flex items-center gap-1 ml-1"
                            :class="autoSwitchEnabled ? 'bg-amber-50 text-amber-700 border-amber-300' : 'bg-slate-200 text-slate-600 border-slate-300'">
                        <span class="w-1.5 h-1.5 rounded-full" :class="autoSwitchEnabled ? 'bg-amber-500 animate-ping' : 'bg-slate-400'"></span>
                        <span x-text="autoSwitchEnabled ? 'Rotasi 40s (' + switchCountdown + 's)' : 'Rotasi Dijeda'"></span>
                    </button>
                </div>

                <!-- Right: Fullscreen Button & Return to Vote -->
                <div class="flex items-center gap-2 shrink-0">
                    <div class="px-3 py-1 rounded-lg bg-amber-50 border border-amber-200 text-center">
                        <span class="text-[9px] font-extrabold uppercase text-amber-700 block">Total Suara MPK</span>
                        <span class="text-sm font-black text-slate-900 font-mono" x-text="displayTotalVotes"></span>
                    </div>

                    <button @click="toggleFullscreen()" 
                            type="button"
                            class="px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-sm transition flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                        <span x-text="isFullscreen ? 'Keluar Fullscreen' : 'Layar Penuh'"></span>
                    </button>

                    <a href="{{ route('pemilos.mpk.vote') }}" 
                       class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs border border-slate-300 transition flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="hidden sm:inline">Bilik Suara MPK</span>
                    </a>
                </div>

            </div>
        </div>

        <!-- SKELETON LOADING STATE -->
        <template x-if="isLoading">
            <div class="p-12 text-center text-slate-500 space-y-3">
                <svg class="w-10 h-10 mx-auto animate-spin text-amber-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-xs font-extrabold text-slate-700 uppercase">Memuat Data Pemilos MPK...</p>
            </div>
        </template>

        <template x-if="!isLoading">
            <div class="flex-1 flex flex-col justify-between space-y-4">
                
                <!-- PAGE 1: LIVE REAL COUNT QUICK COUNT TV FOR MPK -->
                <div x-show="activeTab === 'realcount'" class="space-y-4 flex-1 flex flex-col justify-between">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                        
                        <!-- CARD 1: DOUGHNUT CHART MPK -->
                        <div class="lg:col-span-5 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-md flex flex-col justify-between">
                            <div class="flex items-center justify-between border-b border-slate-200 pb-2 mb-2">
                                <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                    </svg>
                                    <span>DIAGRAM PERSENTASE SUARA MPK</span>
                                </h3>
                                <span class="text-[10px] font-bold text-slate-400">Suara Sah</span>
                            </div>

                            <div class="relative h-64 sm:h-72 w-full flex items-center justify-center p-2">
                                <canvas id="doughnutChartCanvasMpk"></canvas>
                            </div>
                        </div>

                        <!-- CARD 2: BAR CHART MPK -->
                        <div class="lg:col-span-7 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-md flex flex-col justify-between">
                            <div class="flex items-center justify-between border-b border-slate-200 pb-2 mb-2">
                                <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <span>GRAFIK BATANG PEROLEHAN SUARA MPK</span>
                                </h3>
                                <span class="text-[10px] text-slate-500 font-semibold flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                                    Diperbarui: <strong class="text-slate-800 font-mono" x-text="lastUpdated"></strong>
                                </span>
                            </div>

                            <div class="relative h-60 sm:h-64 w-full p-2">
                                <canvas id="barChartCanvasMpk"></canvas>
                            </div>

                            <div class="mt-2 p-2.5 rounded-xl bg-amber-50 border border-amber-200 flex items-center justify-between text-xs font-bold text-amber-900">
                                <span>Perolehan Suara MPK Tertinggi:</span>
                                <span class="font-black text-amber-700 underline" x-text="leaderPaslon ? 'Paslon MPK No. 0' + leaderPaslon.paslon_number + ' (' + leaderPaslon.percentage + '%)' : 'Belum Ada Suara'"></span>
                            </div>
                        </div>

                    </div>

                    <!-- LOWER-THIRD TV QUICK COUNT GRAPHIC FOR MPK -->
                    <div class="w-full space-y-2 pt-2">
                        <div class="max-w-7xl mx-auto w-full grid grid-cols-1 gap-4 sm:gap-6" :class="mappings.length == 2 ? 'sm:grid-cols-2 max-w-4xl' : 'sm:grid-cols-3 max-w-6xl'">
                            <template x-for="(paslon, idx) in mappings" :key="paslon.id">
                                <div class="rounded-xl overflow-hidden shadow-lg border border-slate-300 flex items-center justify-between bg-white transform transition hover:-translate-y-0.5"
                                     :class="idx === 0 ? 'border-l-8 border-l-amber-600' : (idx === 1 ? 'border-l-8 border-l-blue-600' : 'border-l-8 border-l-red-600')">
                                    
                                    <div class="flex items-center gap-2.5 p-2.5 min-w-0 flex-1">
                                        <div class="w-12 h-14 rounded-lg overflow-hidden bg-slate-200 shrink-0 border border-slate-300">
                                            <template x-if="paslon.photo_url">
                                                <img :src="paslon.photo_url" :alt="'Foto Paslon MPK ' + paslon.paslon_number" class="w-full h-full object-cover object-top">
                                            </template>
                                            <template x-if="!paslon.photo_url">
                                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-[8px] text-center font-bold">
                                                    NO PHOTO
                                                </div>
                                            </template>
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <span class="inline-block px-1.5 py-0.5 rounded text-[9px] font-black uppercase text-white bg-slate-800">
                                                MPK 0<span x-text="paslon.paslon_number"></span>
                                            </span>
                                            <h4 class="text-xs font-black text-slate-900 truncate leading-tight mt-0.5" x-text="paslon.chairman_name"></h4>
                                            <p class="text-[10px] text-slate-600 font-bold truncate leading-tight" x-text="paslon.vice_chairman_name"></p>
                                            <p class="text-[9px] text-slate-500 font-mono mt-0.5"><span x-text="paslon.votes_count"></span> Suara</p>
                                        </div>
                                    </div>

                                    <div class="h-full px-3.5 py-2 text-white flex flex-col items-center justify-center shrink-0 min-w-[85px]"
                                         :class="getColor(idx).badgeBg">
                                        <span class="text-2xl font-black font-mono tracking-tight" x-text="paslon.percentage + '%'"></span>
                                        <span class="text-[8px] font-black uppercase tracking-widest opacity-90">QUICK COUNT</span>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="max-w-7xl mx-auto w-full rounded-xl bg-[#0F264A] text-white overflow-hidden border border-slate-800 shadow-md flex items-center h-9">
                            <div class="bg-amber-600 text-white text-[10px] font-black px-3 py-2 uppercase tracking-wider shrink-0 flex items-center gap-1.5 z-10 shadow-md">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span>
                                RUNNING TEXT MPK
                            </div>
                            <div class="overflow-hidden relative flex-1 text-xs font-bold text-amber-200">
                                <div class="animate-marquee font-semibold tracking-wide">
                                    REKAPITULASI HASIL PENGHITUNGAN SUARA KANDIDAT MPK (MAJELIS PERWAKILAN KELAS) SMKS NURUL ISLAM PERIODE 2026/2027 BERLANGSUNG SECARA REALTIME • PILIH KANDIDAT LEGISLATIF MPK ANDA DENGAN BIJAK!
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- PAGE 2: COMPACT SLEEK PROFIL & VISI MISI PASLON MPK -->
                <div x-show="activeTab === 'showcase'" class="space-y-4 max-w-6xl mx-auto w-full flex-1 py-1">
                    
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
                        <div class="flex items-center gap-3 text-center sm:text-left">
                            <div class="w-9 h-9 rounded-xl bg-amber-600 text-white flex items-center justify-center font-black shadow-sm shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-800 text-[9px] font-black uppercase tracking-widest">
                                    PROFIL & KAMPANYE PASLON MPK 2026
                                </span>
                                <h3 class="text-base sm:text-lg font-black text-slate-900 mt-0.5">
                                    PROFIL, VISI, DAN MISI KANDIDAT MPK SMK NURUL ISLAM 2026/2027
                                </h3>
                            </div>
                        </div>
                        <span class="text-xs text-slate-600 font-bold bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200 shrink-0">
                            Total Paslon MPK: <strong class="text-amber-700 font-mono" x-text="mappings.length"></strong> Pasangan
                        </span>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(paslon, idx) in mappings" :key="paslon.id">
                            <div class="bg-white rounded-2xl border-2 overflow-hidden shadow-md transition duration-200 hover:shadow-lg"
                                 :class="idx === 0 ? 'border-amber-500' : (idx === 1 ? 'border-blue-500' : 'border-red-500')">
                                
                                <div class="px-4 py-2.5 text-white flex items-center justify-between"
                                     :class="getColor(idx).badgeBg">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-7 h-7 rounded-lg bg-white text-slate-900 font-black text-sm flex items-center justify-center shadow-sm">
                                            0<span x-text="paslon.paslon_number"></span>
                                        </span>
                                        <h4 class="text-xs font-black uppercase tracking-wider">PASANGAN CALON MPK NOMOR URUT 0<span x-text="paslon.paslon_number"></span></h4>
                                    </div>
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-white/90">PEMILOS MPK SMK NURUL ISLAM 2026</span>
                                </div>

                                <div class="p-4 grid grid-cols-1 lg:grid-cols-12 gap-4 items-center">
                                    
                                    <div class="lg:col-span-5 flex flex-col sm:flex-row items-center gap-3 bg-slate-50 p-3 rounded-xl border border-slate-200">
                                        <div class="w-32 h-40 rounded-xl overflow-hidden bg-slate-200 shrink-0 border border-slate-300">
                                            <template x-if="paslon.photo_url">
                                                <img :src="paslon.photo_url" :alt="'Foto Paslon MPK ' + paslon.paslon_number" class="w-full h-full object-cover object-top">
                                            </template>
                                            <template x-if="!paslon.photo_url">
                                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 p-2 text-center">
                                                    <svg class="w-8 h-8 mb-1 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    <span class="text-[9px] font-bold">NO PHOTO</span>
                                                </div>
                                            </template>
                                        </div>

                                        <div class="space-y-2 min-w-0 flex-1 w-full text-left">
                                            <div class="p-2 rounded-lg bg-white border border-amber-200">
                                                <span class="text-[8px] font-black uppercase text-amber-700 block">CALON KETUA MPK:</span>
                                                <h5 class="text-xs font-black text-slate-900 truncate" x-text="paslon.chairman_name"></h5>
                                                <span class="text-[10px] text-slate-500 font-semibold">Kelas: <strong class="text-slate-800" x-text="paslon.chairman_class"></strong></span>
                                            </div>

                                            <div class="p-2 rounded-lg bg-white border border-sky-200">
                                                <span class="text-[8px] font-black uppercase text-sky-700 block">CALON WAKIL MPK:</span>
                                                <h5 class="text-xs font-black text-slate-900 truncate" x-text="paslon.vice_chairman_name"></h5>
                                                <span class="text-[10px] text-slate-500 font-semibold">Kelas: <strong class="text-slate-800" x-text="paslon.vice_chairman_class"></strong></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="lg:col-span-7 space-y-2.5">
                                        <div class="p-3 rounded-xl bg-amber-50/70 border border-amber-200 space-y-1">
                                            <h6 class="text-[10px] font-black text-amber-800 uppercase tracking-wider flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                                <span>VISI LEGISLATIF MPK</span>
                                            </h6>
                                            <p class="text-xs text-slate-800 leading-relaxed italic" x-text="paslon.vision || 'Visi belum diisi oleh panitia.'"></p>
                                        </div>

                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 space-y-1">
                                            <h6 class="text-[10px] font-black text-slate-800 uppercase tracking-wider flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>MISI LEGISLATIF MPK</span>
                                            </h6>
                                            <div class="text-xs text-slate-800 leading-relaxed whitespace-pre-line" x-text="paslon.mission || 'Misi belum diisi oleh panitia.'"></div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </template>
                    </div>

                </div>

                <!-- PAGE 3: PANDUAN & ALUR DIGITAL E-VOTING MPK -->
                <div x-show="activeTab === 'guide'" class="space-y-6 max-w-7xl mx-auto w-full flex-1 py-2">
                    
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-md flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-2xl bg-amber-600 text-white flex items-center justify-center font-black shadow-md shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <span class="px-2.5 py-0.5 rounded bg-amber-100 text-amber-800 text-[10px] font-black uppercase tracking-widest border border-amber-200">
                                    PANDUAN E-VOTING MPK SMK NURUL ISLAM 2026
                                </span>
                                <h3 class="text-xl font-black text-slate-900 mt-0.5">
                                    PANDUAN & ALUR TATA CARA PEMILIHAN SUARA DIGITAL MPK
                                </h3>
                                <p class="text-xs text-slate-600 font-semibold mt-0.5">
                                    Ikuti 4 langkah E-Voting berikut di unit komputer Bilik Suara SMK Nurul Islam untuk memberikan suara Anda secara sah & rahasia.
                                </p>
                            </div>
                        </div>
                        <span class="px-4 py-2 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs font-black shrink-0">
                            4 Langkah E-Voting MPK
                        </span>
                    </div>

                    <!-- Grand 4-Step Infographic Grid for MPK -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        
                        <div class="bg-white rounded-2xl border-2 border-amber-400 overflow-hidden shadow-lg p-4 flex flex-col justify-between transition hover:-translate-y-1 hover:shadow-xl">
                            <div class="overflow-hidden rounded-xl mb-3 border border-amber-200 shadow-inner bg-slate-100 h-56 sm:h-64 w-full">
                                <img src="{{ asset('images/pemilos/seamless_ai_step1_nuris.png') }}"
                                     alt="1. Menuju Bilik Suara Digital MPK"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-8 h-8 rounded-xl bg-amber-600 text-white font-black text-sm flex items-center justify-center shrink-0 shadow-md">1</span>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-tight">1. Menuju Bilik Suara MPK</h4>
                                    <p class="text-xs text-slate-600 font-medium leading-relaxed mt-1">
                                        Siswa-siswi SMK Nurul Islam menuju unit komputer Bilik Suara digital untuk memilih perwakilan kandidat MPK.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border-2 border-sky-400 overflow-hidden shadow-lg p-4 flex flex-col justify-between transition hover:-translate-y-1 hover:shadow-xl">
                            <div class="overflow-hidden rounded-xl mb-3 border border-sky-200 shadow-inner bg-slate-100 h-56 sm:h-64 w-full">
                                <img src="{{ asset('images/pemilos/seamless_ai_step2_nuris.png') }}"
                                     alt="2. Cermati Pasangan Calon MPK"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-8 h-8 rounded-xl bg-sky-600 text-white font-black text-sm flex items-center justify-center shrink-0 shadow-md">2</span>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-tight">2. Cermati Paslon MPK</h4>
                                    <p class="text-xs text-slate-600 font-medium leading-relaxed mt-1">
                                        Buka halaman Bilik Suara MPK, pelajari profil, foto, serta Visi & Misi dari masing-masing pasangan calon legislatif MPK.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border-2 border-amber-400 overflow-hidden shadow-lg p-4 flex flex-col justify-between transition hover:-translate-y-1 hover:shadow-xl">
                            <div class="overflow-hidden rounded-xl mb-3 border border-amber-200 shadow-inner bg-slate-100 h-56 sm:h-64 w-full">
                                <img src="{{ asset('images/pemilos/seamless_ai_step3_nuris.png') }}"
                                     alt="3. Gunakan Hak Pilih MPK"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-8 h-8 rounded-xl bg-amber-600 text-white font-black text-sm flex items-center justify-center shrink-0 shadow-md">3</span>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-tight">3. Gunakan Hak Pilih MPK</h4>
                                    <p class="text-xs text-slate-600 font-medium leading-relaxed mt-1">
                                        Klik tombol <strong class="text-amber-700">"Pilih Paslon MPK Ini"</strong> pada kandidat pilihan Anda di layar monitor E-Voting.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border-2 border-emerald-400 overflow-hidden shadow-lg p-4 flex flex-col justify-between transition hover:-translate-y-1 hover:shadow-xl">
                            <div class="overflow-hidden rounded-xl mb-3 border border-emerald-200 shadow-inner bg-slate-100 h-56 sm:h-64 w-full">
                                <img src="{{ asset('images/pemilos/seamless_ai_step4_nuris.png') }}"
                                     alt="4. Suara MPK Terverifikasi Digital"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-8 h-8 rounded-xl bg-emerald-600 text-white font-black text-sm flex items-center justify-center shrink-0 shadow-md">4</span>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-tight">4. Suara MPK Terverifikasi</h4>
                                    <p class="text-xs text-slate-600 font-medium leading-relaxed mt-1">
                                        Sistem mencatat suara MPK Anda secara digital & rahasia. Real Count MPK otomatis ter-update secara realtime.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </template>

    </div>
</x-pemilos-layout>
