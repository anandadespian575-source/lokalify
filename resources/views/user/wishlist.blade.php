<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - Lokalify 📍</title>
    <!-- Tailwind CSS CDN & Font Plus Jakarta Sans -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js untuk toggle sidebar -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { 
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #030712;
            color: #f3f4f6;
            overflow-x: hidden; /* Mencegah geser ke samping */
        }

        /* Custom Scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #090d16; }
        ::-webkit-scrollbar-thumb { background: #1f293d; border-radius: 9999px; }

        /* Animasi ringan untuk entry-level device */
        @keyframes heroFadeSlideUp {
            0% { opacity: 0; transform: translateY(12px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-hero-entry {
            animation: heroFadeSlideUp 0.4s ease-out forwards;
        }

        /* Micro-interactions */
        .btn-micro {
            transition: transform 0.15s ease;
        }
        .btn-micro:active {
            transform: scale(0.96) !important;
        }

        .glass-panel {
            background: rgba(15, 23, 42, 0.9);
        }
    </style>
</head>
<body class="bg-[#030712] text-slate-100 min-h-screen flex text-xs antialiased selection:bg-teal-500 selection:text-slate-950" x-data="{ sidebarOpen: false }">

    <!-- OVERLAY MOBILE -->
    <div 
        x-show="sidebarOpen" 
        x-transition:enter="transition-opacity ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false" 
        class="fixed inset-0 bg-slate-950/80 z-40 lg:hidden"
    ></div>

    <!-- SIDEBAR KIRI -->
    <aside 
        class="bg-[#0b1329] text-white flex flex-col justify-between p-4 fixed h-full z-50 transition-transform duration-200 ease-out border-r border-slate-800/80 shadow-2xl w-64"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >
        <div class="space-y-6">
            <!-- Logo Brand (Tanpa Teks PRO) -->
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

            <!-- Navigation Links -->
            <nav class="space-y-1.5">
                <a href="{{ route('user.dashboard') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/60 rounded-xl">
                    <i class="fa-solid fa-house text-sm w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('user.wishlist') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-bold bg-teal-500/10 text-teal-400 border border-teal-500/30 rounded-xl">
                    <i class="fa-solid fa-heart text-rose-400 text-sm w-5 text-center"></i>
                    <span>My Wishlist</span>
                </a>
                <a href="{{ route('user.pengaturan') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/60 rounded-xl">
                    <i class="fa-solid fa-gear text-sm w-5 text-center"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>

        <!-- Bagian Bawah Sidebar -->
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

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 min-h-screen flex flex-col bg-[#030712] lg:ml-64 w-full">
        <!-- TOP NAVBAR -->
        <header class="glass-panel border-b border-slate-800/80 h-16 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-30">
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = !sidebarOpen" class="btn-micro p-2 rounded-xl bg-slate-900 text-teal-400 hover:bg-slate-800 border border-slate-800 lg:hidden">
                    <i class="fa-solid fa-bars text-sm"></i>
                </button>
                <h2 class="text-xs sm:text-sm font-bold text-white tracking-tight flex items-center gap-2">
                    <i class="fa-solid fa-heart text-rose-500"></i>
                    <span class="truncate">My Wishlist Destinations</span>
                </h2>
            </div>
        </header>

        <!-- KONTEN UTAMA WISHLIST -->
        <main class="p-4 sm:p-6 space-y-5 flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full animate-hero-entry">
            
            <!-- Notifikasi Flash Message -->
            @if(session('success'))
                <div class="bg-teal-500/10 border border-teal-500/30 text-teal-300 px-4 py-3 rounded-2xl text-xs font-semibold flex items-center justify-between">
                    <span class="flex items-center gap-2 truncate">
                        <i class="fa-solid fa-circle-check text-teal-400 flex-shrink-0"></i>
                        <span class="truncate">{{ session('success') }}</span>
                    </span>
                </div>
            @endif

            <!-- Grid Destinasi Wishlist (Responsif Bertumpuk ke Bawah di HP) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 items-stretch">
                @forelse($wishlists as $wish)
                    @if($wish->destinasi)
                        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-3.5 space-y-3 shadow-lg flex flex-col justify-between group">
                            <div class="space-y-3">
                                <!-- Foto Destinasi -->
                                <div class="relative w-full aspect-[16/10] rounded-xl overflow-hidden bg-slate-950">
                                    @if($wish->destinasi->foto)
                                        <img src="{{ asset('storage/' . $wish->destinasi->foto) }}" alt="{{ $wish->destinasi->nama_destinasi }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full bg-slate-800 flex items-center justify-center text-teal-400">
                                            <i class="fa-solid fa-mountain-sun text-2xl"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Tombol Hapus dari Wishlist (Toggle) -->
                                    <form action="{{ route('user.wishlist.toggle', $wish->destinasi->id) }}" method="POST" class="absolute top-2 right-2 z-10">
                                        @csrf
                                        <button type="submit" class="btn-micro w-8 h-8 rounded-full bg-slate-950/85 text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center border border-slate-700" title="Hapus dari Wishlist">
                                            <i class="fa-solid fa-heart text-xs"></i>
                                        </button>
                                    </form>

                                    <span class="absolute top-2 left-2 bg-slate-950/85 px-2 py-0.5 rounded-lg text-[9px] font-bold text-teal-300 border border-slate-700">
                                        Saved Places
                                    </span>
                                </div>

                                <!-- Informasi -->
                                <div class="space-y-1">
                                    <h3 class="font-bold text-white text-xs sm:text-sm truncate">{{ $wish->destinasi->nama_destinasi }}</h3>
                                    <p class="text-[10px] text-slate-400 flex items-center space-x-1">
                                        <i class="fa-solid fa-location-dot text-teal-400"></i>
                                        <span class="truncate">{{ $wish->destinasi->alamat ?? 'Ciwidey, Bandung' }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Footer Kartu -->
                            <div class="flex items-center justify-between pt-3 border-t border-slate-800/80">
                                <span class="text-[10px] text-slate-500">Tersimpan</span>
                                <a href="{{ route('user.destinasi.detail', $wish->destinasi->id) }}" class="btn-micro px-3 py-1.5 bg-teal-500 hover:bg-teal-400 text-slate-950 font-bold rounded-lg text-[10px] flex items-center gap-1">
                                    <span>Detail</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                @empty
                    <!-- TAMPILAN KOSONG YANG MENARIK (Responsif di HP) -->
                    <div class="col-span-full flex flex-col items-center justify-center py-16 px-4 text-center bg-slate-900/50 rounded-2xl sm:rounded-3xl border border-slate-800 border-dashed space-y-3 max-w-md mx-auto w-full">
                        <div class="w-14 h-14 rounded-2xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-2xl">
                            💔
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-xs sm:text-sm font-bold text-white tracking-tight">Wishlist Anda Masih Kosong</h3>
                            <p class="text-[11px] text-slate-400 leading-relaxed px-2">Belum ada destinasi wisata menarik yang Anda simpan. Yuk, mulai jelajahi berbagai tempat wisata seru di Lokalify!</p>
                        </div>
                        <a href="{{ route('user.dashboard') }}" class="btn-micro px-4 py-2 bg-teal-500 hover:bg-teal-400 text-slate-950 font-bold rounded-xl text-xs flex items-center space-x-1.5 shadow-md">
                            <i class="fa-solid fa-compass"></i>
                            <span>Jelajahi Destinasi Sekarang</span>
                        </a>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>