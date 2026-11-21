<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Lokalify ✨</title>
    <!-- Tailwind CSS CDN & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { 
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #030712;
            color: #f3f4f6;
            overflow-x: hidden;
        }
        
        /* Custom Scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #090d16; }
        ::-webkit-scrollbar-thumb { background: #1f293d; border-radius: 9999px; }
        
        @keyframes heroFadeSlideUp {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-hero-entry {
            animation: heroFadeSlideUp 0.4s ease-out forwards;
        }

        .reveal-card {
            opacity: 0;
            transform: translateY(15px);
            transition: opacity 0.4s ease-out, transform 0.4s ease-out;
        }
        .reveal-card.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .btn-micro {
            transition: transform 0.15s ease;
        }
        .btn-micro:active {
            transform: scale(0.96) !important;
        }

        .glass-panel {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
    </style>
</head>
<body class="bg-[#030712] text-slate-100 min-h-screen flex text-xs selection:bg-teal-500 selection:text-slate-950 antialiased" 
      x-data="{
          sidebarOpen: false,
          bisnisModalOpen: false,
          leaderboardModalOpen: false,
          isLoading: true,
          isExiting: false,
          navigateWithExit(event) {
              const targetUrl = event.currentTarget.href;
              this.isExiting = true;
              setTimeout(() => {
                  window.location.href = targetUrl;
              }, 100);
          }
      }"
      x-init="setTimeout(() => isLoading = false, 300)">

    <!-- OVERLAY MOBILE -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-slate-950/80 z-40 lg:hidden"></div>

    <!-- SIDEBAR KIRI -->
    <aside 
        class="bg-[#0b1329] text-white flex flex-col justify-between p-4 fixed h-full z-50 transition-transform duration-200 ease-out border-r border-slate-800/80 shadow-2xl w-64"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >
        <div class="space-y-6">
            <div class="flex items-center space-x-3 px-2 py-2">
                <div class="bg-gradient-to-tr from-teal-500 to-emerald-400 p-2.5 rounded-2xl text-slate-950 font-black text-base flex items-center justify-center shadow-lg shadow-teal-500/25 flex-shrink-0">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="overflow-hidden">
                    <h1 class="font-extrabold text-base tracking-tight text-white flex items-center gap-1.5">
                        Lokalify
                    </h1>
                    <p class="text-[10px] text-slate-400 font-medium">Jelajahi Wisata Lokal</p>
                </div>
            </div>

            <nav class="space-y-1.5">
                <a href="{{ route('user.dashboard') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-bold bg-teal-500/10 text-teal-400 border border-teal-500/30 rounded-xl">
                    <i class="fa-solid fa-house text-sm w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('user.wishlist') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/60 rounded-xl">
                    <i class="fa-solid fa-heart text-rose-400 text-sm w-5 text-center"></i>
                    <span>My Wishlist</span>
                </a>
                <a href="{{ route('user.pengaturan') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/60 rounded-xl">
                    <i class="fa-solid fa-gear text-sm w-5 text-center"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>

        <div class="space-y-3 pt-4 border-t border-slate-800/80">
            <div class="flex items-center justify-between p-2 rounded-xl bg-slate-900/60 border border-slate-800/60">
                <div class="flex items-center space-x-2.5 overflow-hidden">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-teal-400 to-emerald-600 text-slate-950 font-black flex items-center justify-center text-xs flex-shrink-0">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-bold text-white truncate leading-tight">{{ auth()->user()->name ?? 'Profile' }}</p>
                        <p class="text-[10px] text-slate-400 truncate">@user</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-micro text-slate-400 hover:text-rose-400 p-2 hover:bg-rose-500/10 rounded-lg" title="Keluar">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="flex-1 min-h-screen flex flex-col bg-[#030712] lg:ml-64 w-full" 
         :class="{ 'opacity-50 transition-opacity duration-150': isExiting }"
    >
        <header class="glass-panel border-b border-slate-800/80 h-16 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-30">
            <div class="flex items-center space-x-3 flex-1 max-w-xl">
                <button @click="sidebarOpen = !sidebarOpen" class="btn-micro p-2 rounded-xl bg-slate-900 text-teal-400 hover:bg-slate-800 border border-slate-800 lg:hidden flex-shrink-0">
                    <i class="fa-solid fa-bars text-sm"></i>
                </button>

                <div class="relative w-full" 
                     x-data="{ 
                        query: '{{ request('search') }}',
                        items: {{ json_encode($semuaDestinasi ?? []) }},
                        focused: false,
                        get filtered() {
                            if (!this.query.trim()) return [];
                            return this.items.filter(item => 
                                item.nama_destinasi.toLowerCase().includes(this.query.toLowerCase()) ||
                                (item.alamat && item.alamat.toLowerCase().includes(this.query.toLowerCase()))
                            );
                        }
                     }"
                     @click.outside="focused = false"
                >
                    <form action="{{ route('user.dashboard') }}" method="GET" class="relative w-full">
                        <input 
                            type="text" 
                            name="search" 
                            x-model="query"
                            @focus="focused = true"
                            @input="focused = true"
                            placeholder="Cari destinasi..." 
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl pl-9 pr-8 py-2 text-xs text-slate-200 placeholder-slate-500 focus:outline-none focus:border-teal-500"
                            autocomplete="off"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </div>
                    </form>

                    <div x-show="focused && filtered.length > 0" 
                         class="absolute top-full left-0 right-0 mt-1 bg-slate-900 border border-slate-800 rounded-xl shadow-2xl overflow-hidden z-50 max-h-56 overflow-y-auto"
                    >
                        <template x-for="item in filtered" :key="item.id">
                            <a :href="'{{ url('user/destinasi') }}/' + item.id" 
                               @click.prevent="navigateWithExit($event)"
                               class="block px-3.5 py-2 hover:bg-teal-500/10 border-b border-slate-800/40"
                            >
                                <p class="text-xs font-bold text-white" x-text="item.nama_destinasi"></p>
                                <p class="text-[10px] text-slate-400 truncate" x-text="item.alamat ?? 'Ciwidey, Bandung'"></p>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-2 ml-2 flex-shrink-0">
                <button @click="bisnisModalOpen = true" class="btn-micro px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 border border-slate-800 text-xs font-semibold flex items-center gap-1">
                    <i class="fa-solid fa-briefcase text-teal-400 text-xs"></i>
                    <span class="hidden sm:inline">Bisnis</span>
                </button>
                <button type="button" @click="leaderboardModalOpen = true" class="btn-micro px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 border border-slate-800 text-xs font-semibold flex items-center gap-1">
                    <i class="fa-solid fa-trophy text-amber-400 text-xs"></i>
                    <span class="hidden sm:inline">Leaderboard</span>
                </button>
            </div>
        </header>

        <main class="p-4 sm:p-6 space-y-6 flex-1 max-w-7xl mx-auto w-full">

            <!-- HERO BANNER -->
            <div class="animate-hero-entry relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-[#0a192f] to-slate-950 border border-slate-800/80 p-5 sm:p-8 shadow-xl">
                <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="space-y-3 max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-500/10 border border-teal-500/20 text-teal-400 font-bold text-[10px] tracking-wider uppercase">
                            <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                            Ready for Next Adventure?
                        </div>
                        <h1 class="text-xl sm:text-2xl md:text-3xl font-black text-white tracking-tight leading-snug">
                            Halo, <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-400 via-emerald-300 to-cyan-400">{{ auth()->user()->name ?? 'Petualang' }}</span>! 👋
                        </h1>
                        <p class="text-slate-300 text-xs sm:text-sm font-normal leading-relaxed">
                            Jangan cuma wacana! Cari udara segar, temukan surga tersembunyi lokal, dan buat momen seru bareng <span class="text-teal-400 font-bold">Lokalify</span> hari ini.
                        </p>
                    </div>

                    <div class="flex flex-col w-full md:w-auto pt-4 md:pt-0 border-t md:border-t-0 border-slate-800/80 gap-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Media Sosial:</span>
                        <div class="grid grid-cols-3 gap-2 w-full sm:w-auto">
                            <a href="https://www.tiktok.com/@brokolii_047" target="_blank" class="btn-micro flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-slate-900 text-slate-200 border border-slate-800">
                                <i class="fa-brands fa-tiktok text-cyan-400"></i>
                                <span class="font-bold text-[10px]">TikTok</span>
                            </a>
                            <a href="https://www.instagram.com/hey_nezhh" target="_blank" class="btn-micro flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-slate-900 text-slate-200 border border-slate-800">
                                <i class="fa-brands fa-instagram text-pink-400"></i>
                                <span class="font-bold text-[10px]">IG</span>
                            </a>
                            <a href="https://youtube.com/@lokalify-s4w" target="_blank" class="btn-micro flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-slate-900 text-slate-200 border border-slate-800">
                                <i class="fa-brands fa-youtube text-rose-500"></i>
                                <span class="font-bold text-[10px]">YouTube</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CATEGORY SECTION -->
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-white tracking-tight">Kategori Wisata</h2>
                        <p class="text-[10px] sm:text-[11px] text-slate-400">Eksplorasi tempat favorit berdasarkan opsi kategori</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 overflow-x-auto py-1 no-scrollbar w-full">
                    <a href="{{ route('user.dashboard') }}" class="btn-micro px-3.5 py-2 rounded-xl text-[11px] font-bold whitespace-nowrap {{ !request('kategori') ? 'bg-teal-500 text-slate-950 shadow-md shadow-teal-500/20' : 'bg-slate-900 text-slate-300 border border-slate-800' }}">Semua Tempat</a>
                    @php
                        $listKategori = \App\Models\Kategori::all();
                    @endphp
                    @foreach ($listKategori as $kat)
                        <a href="{{ route('user.dashboard', ['kategori' => $kat->id]) }}" class="btn-micro px-3.5 py-2 rounded-xl text-[11px] font-bold whitespace-nowrap {{ request('kategori') == $kat->id ? 'bg-teal-500 text-slate-950 shadow-md shadow-teal-500/20' : 'bg-slate-900 text-slate-300 border border-slate-800' }}">{{ $kat->nama_kategori }}</a>
                    @endforeach
                </div>
            </div>

            <!-- SKELETON LOADING STATE -->
            <div x-show="isLoading" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                <template x-for="i in 4" :key="i">
                    <div class="bg-slate-900/60 border border-slate-800/80 rounded-2xl p-4 space-y-3 animate-pulse">
                        <div class="w-full aspect-video rounded-xl bg-slate-800"></div>
                        <div class="space-y-2">
                            <div class="h-4 bg-slate-800 rounded w-3/4"></div>
                            <div class="h-3 bg-slate-800 rounded w-1/2"></div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- GRID KARTU DESTINASI (Diurutkan berdasarkan rating tertinggi & menampilkan semua data) -->
            <div x-show="!isLoading" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 items-stretch">
                @php
                    $rawDestinasi = isset($destinasi) && count($destinasi) > 0 ? $destinasi : \App\Models\Destinasi::with(['kategori', 'reviews'])->get();
                    
                    // Urutkan secara descending berdasarkan rata-rata rating terbaik
                    $activeDestinasi = collect($rawDestinasi)->sortByDesc(function ($item) {
                        return $item->reviews && $item->reviews->count() > 0 ? $item->reviews->avg('rating') : 0;
                    })->values();
                @endphp

                @if(count($activeDestinasi) > 0)
                    @foreach ($activeDestinasi as $index => $item)
                        <div class="reveal-card bg-slate-900/80 border border-slate-800 rounded-2xl p-3.5 space-y-3 shadow-lg flex flex-col justify-between group">
                            <div class="space-y-3">
                                <div class="relative w-full aspect-[16/10] rounded-xl overflow-hidden bg-slate-950">
                                    @if(!empty($item->foto))
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_destinasi }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full bg-slate-800 flex items-center justify-center text-teal-400">
                                            <i class="fa-solid fa-mountain-sun text-2xl"></i>
                                        </div>
                                    @endif
                                    <span class="absolute top-2 left-2 bg-slate-950/80 px-2 py-0.5 rounded-lg text-[9px] font-bold text-teal-300 border border-slate-700">
                                        {{ $item->kategori->nama_kategori ?? 'Wisata' }}
                                    </span>
                                </div>

                                <div class="space-y-1">
                                    <h3 class="font-bold text-white text-xs sm:text-sm line-clamp-1">{{ $item->nama_destinasi }}</h3>
                                    <p class="text-[10px] text-slate-400 flex items-center space-x-1">
                                        <i class="fa-solid fa-location-dot text-teal-400"></i>
                                        <span class="truncate">{{ $item->alamat ?? 'Ciwidey, Bandung' }}</span>
                                    </p>
                                </div>
                            </div>

                            @php
                                $totalReviews = $item->reviews ? $item->reviews->count() : 0;
                                $avgRating = $totalReviews > 0 ? round($item->reviews->avg('rating'), 1) : 0;
                            @endphp

                            <div class="flex items-center justify-between pt-3 border-t border-slate-800/80">
                                <div class="flex items-center space-x-1 text-amber-400 font-bold text-[11px]">
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <span>{{ number_format($avgRating, 1) }}</span>
                                    <span class="text-slate-500 text-[9px]">({{ $totalReviews }})</span>
                                </div>
                                <a href="{{ route('user.destinasi.detail', $item->id) }}" 
                                   @click.prevent="navigateWithExit($event)"
                                   class="btn-micro px-3 py-1.5 bg-teal-500 hover:bg-teal-400 text-slate-950 font-bold rounded-lg text-[10px] flex items-center gap-1"
                                >
                                    <span>Detail</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full py-12 text-center bg-slate-900/50 rounded-2xl border border-slate-800 border-dashed">
                        <p class="text-xs text-slate-400">Belum ada destinasi wisata di database.</p>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- MODAL LEADERBOARD -->
    @php
        $leaderboardSource = \App\Models\Destinasi::with(['kategori', 'reviews'])->get();
        $leaderboardWisata = collect($leaderboardSource)->map(function ($wisata) {
            $ulasan = $wisata->reviews ?? collect();
            $jumlahUlasan = $ulasan->count();
            $totalBintang = $ulasan->sum('rating');
            return (object) [
                'destinasi' => $wisata,
                'kategori_id' => (string) $wisata->kategori_id,
                'total_ulasan' => $jumlahUlasan,
                'persentase' => $jumlahUlasan > 0 ? ($totalBintang / ($jumlahUlasan * 5)) * 100 : 0,
                'rating' => $jumlahUlasan > 0 ? $totalBintang / $jumlahUlasan : 0,
            ];
        })->sortByDesc('persentase')->take(50)->values();
        $modalKategori = \App\Models\Kategori::all();
    @endphp

    <div x-cloak x-show="leaderboardModalOpen"
         x-data="{ selectedLeaderboardKat: 'all' }"
         class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6 bg-slate-950/80"
         style="display:none;">
        <div @click.outside="leaderboardModalOpen = false"
             class="w-full max-w-3xl max-h-[85vh] rounded-3xl bg-slate-900 border border-slate-800 shadow-2xl flex flex-col overflow-hidden">
            
            <div class="p-4 sm:p-5 bg-slate-950 border-b border-slate-800 flex items-center justify-between">
                <div>
                    <h2 class="text-base sm:text-lg font-extrabold text-white">Leaderboard Wisata</h2>
                    <p class="text-[10px] text-slate-400">Peringkat destinasi terbaik berdasarkan ulasan.</p>
                </div>
                <button @click="leaderboardModalOpen = false" class="btn-micro w-8 h-8 rounded-xl bg-slate-800 text-slate-400 hover:text-white flex items-center justify-center">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="px-4 py-2.5 bg-slate-900/90 border-b border-slate-800 flex items-center gap-2 overflow-x-auto no-scrollbar">
                <button @click="selectedLeaderboardKat = 'all'" :class="selectedLeaderboardKat === 'all' ? 'bg-teal-500 text-slate-950 font-bold' : 'bg-slate-800 text-slate-300'" class="btn-micro px-3 py-1.5 rounded-xl text-[10px] whitespace-nowrap">Semua</button>
                @foreach($modalKategori as $kat)
                    <button @click="selectedLeaderboardKat = '{{ (string)$kat->id }}'" :class="selectedLeaderboardKat === '{{ (string)$kat->id }}' ? 'bg-teal-500 text-slate-950 font-bold' : 'bg-slate-800 text-slate-300'" class="btn-micro px-3 py-1.5 rounded-xl text-[10px] whitespace-nowrap">{{ $kat->nama_kategori }}</button>
                @endforeach
            </div>

            <div class="overflow-y-auto p-4 space-y-2.5 flex-1">
                @forelse($leaderboardWisata as $index => $wisata)
                    <div x-show="selectedLeaderboardKat === 'all' || selectedLeaderboardKat === '{{ $wisata->kategori_id }}'"
                         class="flex items-center gap-3 p-3 rounded-xl bg-slate-950/60 border border-slate-800">
                        <div class="w-6 text-center font-bold text-xs text-slate-400">{{ $index + 1 }}</div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-white truncate">{{ $wisata->destinasi->nama_destinasi }}</p>
                            <p class="text-[10px] text-amber-400 mt-0.5"><i class="fa-solid fa-star"></i> {{ number_format($wisata->rating, 1) }} ({{ $wisata->total_ulasan }} ulasan)</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span class="text-xs font-black text-teal-400">{{ number_format($wisata->persentase, 1) }}%</span>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-xs text-slate-500 py-6">Belum ada data leaderboard.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- MODAL BISNIS -->
    <div x-show="bisnisModalOpen" class="fixed inset-0 bg-slate-950/80 z-50 flex items-center justify-center p-4" style="display: none;">
        <div @click.outside="bisnisModalOpen = false" class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-lg p-5 space-y-4 shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <h3 class="font-bold text-white text-sm">Kemitraan Bisnis Lokalify</h3>
                <button @click="bisnisModalOpen = false" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <p class="text-xs text-slate-300 leading-relaxed">Promosikan tempat wisatamu melalui Lokalify dan jangkau lebih banyak wisatawan.</p>
            <div class="space-y-2">
                <a href="https://wa.me/628981345475" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-emerald-600 text-white font-bold text-xs">
                    <i class="fa-brands fa-whatsapp text-base"></i> Despian Ananda (+62 898-1345-475)
                </a>
                <a href="https://wa.me/6283834041347" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-emerald-600 text-white font-bold text-xs">
                    <i class="fa-brands fa-whatsapp text-base"></i> Irvan Zainudin Ilham (+62 838-3404-1347)
                </a>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal-card').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>