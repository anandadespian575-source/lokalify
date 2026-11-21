<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Destinasi - Lokalify Admin 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { 
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #030712;
            color: #f3f4f6;
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(51, 65, 85, 0.8);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #0b1329 0%, #030712 100%);
        }
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #090d16;
        }
        ::-webkit-scrollbar-thumb {
            background: #1f293d;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #14b8a6;
        }
        .btn-micro {
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-micro:active {
            transform: scale(0.95) !important;
        }
        .glow-teal {
            box-shadow: 0 20px 50px -10px rgba(20, 184, 166, 0.12);
        }
        .glass-panel {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
    </style>
</head>
<body class="bg-[#030712] text-slate-100 flex min-h-screen text-xs antialiased selection:bg-teal-500 selection:text-slate-950" x-data="{ sidebarOpen: false }">

    <!-- OVERLAY MOBILE -->
    <div 
        x-show="sidebarOpen" 
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false" 
        class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-40 md:hidden"
    ></div>

    <!-- Sidebar Navigation -->
    <aside class="w-64 sidebar-gradient text-white p-5 flex flex-col justify-between fixed md:static h-screen z-50 transition-all duration-300 ease-out border-r border-slate-800/80 shadow-2xl"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
        <div>
            <!-- Logo Header -->
            <div class="flex items-center gap-3 mb-8 px-2 group cursor-pointer">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-teal-500 to-emerald-400 flex items-center justify-center text-slate-950 font-black text-base shadow-lg shadow-teal-500/25 group-hover:scale-105 transition-transform duration-300">
                    🏔️
                </div>
                <div>
                    <h1 class="text-base font-extrabold text-white tracking-tight flex items-center gap-1.5">
                        Lokalify <span class="text-[9px] px-1.5 py-0.5 rounded-full bg-teal-500/10 text-teal-400 font-semibold border border-teal-500/20">ADMIN</span>
                    </h1>
                    <p class="text-[10px] text-slate-400 font-medium">Jelajahi Ciwidey, Temukan Cerita</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5 text-xs font-semibold">
                <a href="/admin/dashboard" class="btn-micro flex items-center gap-3.5 py-2.5 px-4 rounded-xl text-slate-400 hover:bg-slate-800/60 hover:text-white transition duration-200">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="/admin/destinasi" class="btn-micro flex items-center gap-3.5 py-2.5 px-4 rounded-xl bg-teal-500/10 text-teal-400 border border-teal-500/30 shadow-sm transition duration-200">
                    <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Kelola Destinasi
                </a>
                <a href="/admin/kategori" class="btn-micro flex items-center gap-3.5 py-2.5 px-4 rounded-xl text-slate-400 hover:bg-slate-800/60 hover:text-white transition duration-200">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Kategori
                </a>
                <a href="/admin/laporan" class="btn-micro flex items-center gap-3.5 py-2.5 px-4 rounded-xl text-slate-400 hover:bg-slate-800/60 hover:text-white transition duration-200">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Laporan User
                </a>
                <a href="/admin/laporan-destinasi" class="btn-micro flex items-center gap-3.5 py-2.5 px-4 rounded-xl text-slate-400 hover:bg-slate-800/60 hover:text-white transition duration-200">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Laporan Destinasi
                </a>
                <a href="/admin/pengaturan" class="btn-micro flex items-center gap-3.5 py-2.5 px-4 rounded-xl text-slate-400 hover:bg-slate-800/60 hover:text-white transition duration-200">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Pengaturan
                </a>
            </nav>

            <!-- Sidebar Promo Card -->
            <div class="mt-8 relative overflow-hidden rounded-2xl p-4 bg-gradient-to-br from-teal-500/10 via-slate-900 to-slate-950 border border-teal-500/20 shadow-lg">
                <div class="relative z-10">
                    <p class="text-[10px] font-bold text-teal-400 uppercase tracking-wider">Jelajah Ciwidey</p>
                    <p class="text-[11px] text-slate-300 mt-0.5 mb-3">Bersama Lokalify!</p>
                    <button class="btn-micro w-7 h-7 rounded-lg bg-teal-500 text-slate-950 flex items-center justify-center font-bold text-xs shadow-md hover:bg-teal-400">
                        →
                    </button>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="pt-6 border-t border-slate-800/80">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn-micro w-full bg-slate-900/80 hover:bg-rose-500/15 text-slate-300 hover:text-rose-400 py-2.5 rounded-xl font-bold text-xs transition-all duration-200 flex items-center justify-center gap-2 border border-slate-800 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto bg-[#030712]">
        
        <!-- Topbar Navigation -->
        <header class="glass-panel border-b border-slate-800/80 px-6 py-3.5 flex justify-between items-center sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="btn-micro text-slate-400 hover:text-white md:hidden p-2 rounded-xl bg-slate-900 border border-slate-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <!-- Search Box -->
                <div class="relative w-64 sm:w-80 md:w-96">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" placeholder="Cari destinasi, kategori, atau laporan..." class="w-full pl-10 pr-16 py-2 rounded-xl bg-slate-900 border border-slate-800 focus:bg-slate-950 focus:border-teal-500/80 focus:outline-none text-xs text-slate-200 placeholder-slate-500 transition">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2.5">
                        <kbd class="px-1.5 py-0.5 text-[9px] font-semibold text-slate-400 bg-slate-800 border border-slate-700 rounded-md">Ctrl + K</kbd>
                    </span>
                </div>
            </div>

            <!-- Profile & Notifications -->
            <div class="flex items-center gap-3">
                <button class="btn-micro relative w-9 h-9 rounded-xl bg-slate-900 hover:bg-slate-800 flex items-center justify-center text-slate-300 border border-slate-800 shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-rose-500"></span>
                </button>
                <button class="btn-micro w-9 h-9 rounded-xl bg-slate-900 hover:bg-slate-800 flex items-center justify-center text-teal-400 border border-slate-800 shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>

                <div class="h-5 w-px bg-slate-800 mx-1"></div>

                <div class="flex items-center gap-2.5 cursor-pointer">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-teal-400 to-emerald-600 flex items-center justify-center text-slate-950 font-black text-xs overflow-hidden border border-slate-700 shadow-md">
                        👤
                    </div>
                    <div class="text-left hidden sm:block">
                        <h4 class="text-xs font-bold text-white leading-none">Admin Panel</h4>
                        <p class="text-[10px] text-slate-400 mt-0.5">Administrator</p>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </header>

        <!-- Body Content -->
        <div class="p-6 max-w-5xl mx-auto w-full space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 animate__animated animate__fadeInDown">
                <div>
                    <h2 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                        <span>Detail Destinasi Wisata</span> <span class="text-base">🗺️</span>
                    </h2>
                    <p class="text-xs text-slate-400 font-medium mt-1">Informasi lengkap tempat wisata dari database.</p>
                </div>
                <a href="{{ route('admin.destinasi.index') }}" class="btn-micro bg-slate-900 hover:bg-slate-800 text-slate-300 border border-slate-800 px-4 py-2.5 rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>

            <div class="glass-card rounded-3xl shadow-2xl p-6 sm:p-8 max-w-4xl mx-auto border border-slate-800/80 space-y-6 animate__animated animate__fadeInUp w-full glow-teal">
                
                <!-- Foto Utama -->
                <div class="w-full max-w-md mx-auto aspect-square rounded-2xl overflow-hidden shadow-xl bg-slate-950 border border-slate-800 relative">
                    @if(!empty($destinasi->foto))
                        <img src="{{ asset('storage/' . $destinasi->foto) }}" alt="{{ $destinasi->nama_destinasi }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-slate-900 to-[#0a192f] flex flex-col items-center justify-center text-white shadow-md">
                            <span class="text-4xl mb-2">🏔️</span>
                            <span class="font-extrabold text-xs text-slate-400">Tidak ada foto utama yang diunggah</span>
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-teal-400 bg-teal-500/10 px-3 py-1 rounded-full border border-teal-500/20 inline-block">
                            {{ $destinasi->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                        </span>
                        <h3 class="text-xl font-extrabold text-white mt-1">{{ $destinasi->nama_destinasi }}</h3>
                        <p class="text-xs text-slate-400 mt-1 flex items-center gap-1.5">
                            <i class="fa-solid fa-location-dot text-teal-400 text-[10px]"></i> {{ $destinasi->alamat ?? 'Alamat belum diisi' }}
                        </p>
                    </div>
                    <div class="bg-slate-950/60 p-4 rounded-2xl border border-slate-800/80 flex flex-col justify-center">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Jam Operasional</p>
                        <p class="text-xs font-bold text-slate-200 mt-1 flex items-center gap-1.5">
                            <i class="fa-regular fa-clock text-teal-400 text-[11px]"></i> {{ $destinasi->jam_buka ?? '08:00 - 17:00 WIB' }}
                        </p>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <h4 class="text-[11px] font-bold text-slate-300 uppercase tracking-wider">Profil Singkat</h4>
                    <p class="text-xs text-slate-300 bg-slate-950/60 p-4 rounded-2xl border border-slate-800/80 leading-relaxed">
                        {{ $destinasi->deskripsi_singkat ?? 'Belum ada profil singkat untuk destinasi ini.' }}
                    </p>
                </div>

                <div class="space-y-1.5">
                    <h4 class="text-[11px] font-bold text-slate-300 uppercase tracking-wider">Detail Lengkap & Fasilitas</h4>
                    <div class="text-xs text-slate-300 bg-slate-950/60 p-4 rounded-2xl border border-slate-800/80 leading-relaxed">
                        {!! $destinasi->deskripsi_lengkap ?? 'Belum ada detail lengkap untuk destinasi ini.' !!}
                    </div>
                </div>

                @if($destinasi->link_maps)
                    <div class="space-y-1.5 pt-2 border-t border-slate-800">
                        <h4 class="text-[11px] font-bold text-slate-300 uppercase tracking-wider">Link Google Maps</h4>
                        <a href="{{ $destinasi->link_maps }}" target="_blank" class="text-xs font-bold text-teal-400 hover:underline break-all flex items-center gap-1.5">
                            <i class="fa-solid fa-map-location-dot text-[11px]"></i> {{ $destinasi->link_maps }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html>