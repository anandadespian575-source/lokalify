<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Lokalify ✨</title>
    <!-- Tailwind CSS CDN & Font Plus Jakarta Sans -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* 1. ANIMASI HERO / BERANDA: Fade In + Slide Up Ringan */
        @keyframes heroFadeSlideUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-hero-entry {
            animation: heroFadeSlideUp 0.6s ease-out forwards;
        }

        @keyframes float-parallax-1 {
            0%, 100% { transform: translate(0px, 0px); }
            50% { transform: translate(10px, -10px); }
        }
        @keyframes float-parallax-2 {
            0%, 100% { transform: translate(0px, 0px); }
            50% { transform: translate(-10px, 10px); }
        }
        .parallax-bg-1 { animation: float-parallax-1 12s ease-in-out infinite; }
        .parallax-bg-2 { animation: float-parallax-2 15s ease-in-out infinite; }

        /* 2. ANIMASI CHAT LOKALIFY */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        .animate-float-ai {
            animation: float-slow 4.5s ease-in-out infinite;
        }

        /* 3. SCROLL REVEAL KARTU */
        .reveal-card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
        .reveal-card.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* 4. ANIMASI KELUAR (EXIT ANIMATION) DIPEREPAT MENJADI INSTAN/CEPAT */
        @keyframes fastExit {
            0% { opacity: 1; transform: scale(1); }
            100% { opacity: 0; transform: scale(0.98); }
        }
        .page-exit-animation {
            animation: fastExit 0.2s ease-in forwards;
            pointer-events: none;
        }

        /* 5. MICROINTERACTION TOMBOL */
        .btn-micro {
            transition: transform 0.15s ease, background-color 0.2s ease;
        }
        .btn-micro:active {
            transform: scale(0.95) !important;
        }

        /* 6. INDIKATOR MENGETIK AI */
        @keyframes dotBlink {
            0%, 80%, 100% { opacity: 0.3; transform: scale(0.8); }
            40% { opacity: 1; transform: scale(1.3); }
        }
        .typing-dot {
            animation: dotBlink 1.6s infinite ease-in-out both;
        }
        .typing-dot:nth-child(1) { animation-delay: 0s; }
        .typing-dot:nth-child(2) { animation-delay: 0.25s; }
        .typing-dot:nth-child(3) { animation-delay: 0.5s; }

        .glow-teal {
            box-shadow: 0 0 40px -5px rgba(20, 184, 166, 0.15);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex text-xs selection:bg-teal-500 selection:text-slate-950" 
      x-data="{
          sidebarOpen: false,
          aiOpen: false,
          bisnisModalOpen: false,
          leaderboardModalOpen: false,
          isLoading: true,
          isExiting: false,
          navigateWithExit(event) {
              const targetUrl = event.currentTarget.href;
              this.isExiting = true;
              setTimeout(() => {
                  window.location.href = targetUrl;
              }, 150);
          }
      }"
      x-init="setTimeout(() => isLoading = false, 400)">

    <!-- OVERLAY MOBILE -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-md z-30 lg:hidden"></div>

    <!-- SIDEBAR KIRI -->
    <aside 
        class="bg-[#07162d] text-white flex flex-col justify-between p-4 fixed h-screen z-40 transition-all duration-300 ease-out border-r border-slate-800 shadow-2xl w-60"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <div class="space-y-6">
            <div class="flex items-center space-x-3 px-1 py-1">
                <div class="bg-teal-500 p-2 rounded-xl text-slate-950 font-extrabold text-sm flex items-center justify-center shadow-lg shadow-teal-500/20 flex-shrink-0">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="whitespace-nowrap overflow-hidden">
                    <h1 class="font-extrabold text-sm tracking-wide text-white">Lokalify</h1>
                    <p class="text-[10px] text-teal-400 font-medium">Jelajahi Wisata Lokal</p>
                </div>
            </div>

            <nav class="space-y-1.5">
                <a href="<?php echo e(route('user.dashboard')); ?>" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-bold bg-teal-500 text-slate-950 rounded-xl shadow-md shadow-teal-500/20 hover:bg-teal-400">
                    <i class="fa-solid fa-house text-sm w-4 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?php echo e(route('user.wishlist')); ?>" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl">
                    <i class="fa-solid fa-heart text-rose-400 text-sm w-4 text-center"></i>
                    <span>My Wishlist</span>
                </a>
                <a href="<?php echo e(route('user.pengaturan')); ?>" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl">
                    <i class="fa-solid fa-gear text-sm w-4 text-center"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>

        <div class="space-y-3 pt-4 border-t border-slate-800/80">
            <div class="flex items-center justify-between px-2 py-1">
                <div class="flex items-center space-x-2.5 overflow-hidden">
                    <div class="w-8 h-8 rounded-lg bg-teal-500 text-slate-950 font-black flex items-center justify-center text-xs flex-shrink-0">
                        <?php echo e(substr(auth()->user()->name ?? 'U', 0, 1)); ?>

                    </div>
                    <div class="truncate">
                        <p class="text-xs font-bold text-white truncate leading-tight"><?php echo e(auth()->user()->name ?? 'Profile'); ?></p>
                        <p class="text-[10px] text-slate-400 truncate">@user</p>
                    </div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-micro text-slate-400 hover:text-rose-400 p-1.5" title="Keluar">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="flex-1 min-h-screen flex flex-col transition-all duration-300 ease-out bg-slate-950" 
         :class="{ 'lg:ml-60': sidebarOpen, 'page-exit-animation': isExiting }"
    >
        <header class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800 h-16 flex items-center justify-between px-6 sticky top-0 z-20">
            <div class="flex items-center space-x-4">
                <button @click="sidebarOpen = !sidebarOpen" class="btn-micro p-2 rounded-xl bg-slate-800 text-teal-400 hover:bg-slate-700 border border-slate-700">
                    <i class="fa-solid fa-bars text-sm"></i>
                </button>

                <!-- FORM SEARCH -->
                <div class="relative hidden sm:block w-72 md:w-96" 
                     x-data="{ 
                        query: '<?php echo e(request('search')); ?>',
                        items: <?php echo e(json_encode($semuaDestinasi ?? [])); ?>,
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
                    <form action="<?php echo e(route('user.dashboard')); ?>" method="GET" class="relative w-full">
                        <input 
                            type="text" 
                            name="search" 
                            x-model="query"
                            @focus="focused = true"
                            @input="focused = true"
                            placeholder="Cari destinasi..." 
                            class="w-full bg-slate-800/90 border border-slate-700 rounded-2xl pl-4 pr-11 py-2 text-xs text-slate-200 focus:outline-none focus:border-teal-500 transition-all duration-300"
                            autocomplete="off"
                        >
                        <button type="submit" class="btn-micro absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-teal-400" title="Cari">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </form>

                    <!-- REKOMENDASI PENCARIAN -->
                    <div x-show="focused && filtered.length > 0" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         class="absolute top-full left-0 right-0 mt-2 bg-slate-900 border border-slate-700 rounded-2xl shadow-2xl overflow-hidden z-50 max-h-60 overflow-y-auto"
                    >
                        <div class="p-2.5 text-[10px] text-slate-400 font-bold border-b border-slate-800">
                            Rekomendasi kata kunci untuk "<span x-text="query"></span>":
                        </div>
                        <template x-for="item in filtered" :key="item.id">
                            <a :href="'<?php echo e(url('user/destinasi')); ?>/' + item.id" 
                               @click.prevent="navigateWithExit($event)"
                               class="block px-4 py-2.5 hover:bg-slate-800 transition border-b border-slate-800/50 last:border-none group"
                            >
                                <p class="text-xs font-bold text-white group-hover:text-teal-400 transition" x-text="item.nama_destinasi"></p>
                                <p class="text-[10px] text-teal-400/80 truncate mt-0.5" x-text="item.alamat ?? 'Ciwidey, Bandung'"></p>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <!-- TOMBOL TAMBAHAN DI NAVBAR (BISNIS & LEADERBOARD) -->
            <div class="flex items-center space-x-3">
                <!-- TOMBOL BISNIS MEMBUKA MODAL -->
                <button @click="bisnisModalOpen = true" class="btn-micro px-3 py-1.5 rounded-xl bg-slate-800 text-slate-300 hover:text-white border border-slate-700 text-xs font-bold">Bisnis</button>
                <button type="button" @click="leaderboardModalOpen = true" class="btn-micro px-3 py-1.5 rounded-xl bg-slate-800 text-slate-300 hover:text-white border border-slate-700 text-xs font-bold">Leaderboard</button>
                
                <button class="btn-micro w-9 h-9 rounded-xl bg-slate-800 text-slate-300 flex items-center justify-center border border-slate-700 hover:text-white"><i class="fa-regular fa-bell text-xs"></i></button>
            </div>
        </header>

        <main class="p-6 space-y-6 flex-1 max-w-7xl mx-auto w-full">

            <!-- HERO BANNER -->
            <div class="animate-hero-entry relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-[#0a233c] to-slate-900 border border-slate-800/80 p-6 md:p-8 shadow-2xl glow-teal group">
                <div class="parallax-bg-1 absolute -top-12 -right-12 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="parallax-bg-2 absolute -bottom-10 -left-10 w-48 h-48 bg-blue-600/10 rounded-full blur-2xl pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="space-y-2.5 max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-500/10 border border-teal-500/20 text-teal-400 font-bold text-[10px] tracking-wide uppercase">
                            <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                            Ready for Next Adventure?
                        </div>
                        <h1 class="text-xl md:text-2xl font-black text-white tracking-tight leading-tight">
                            Halo, <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-400 via-emerald-300 to-cyan-400"><?php echo e(auth()->user()->name ?? 'Petualang'); ?></span>! 👋
                        </h1>
                        <p class="text-slate-300 text-xs md:text-sm font-medium leading-relaxed">
                            Jangan cuma wacana! Cari udara segar, temukan surga tersembunyi lokal, dan buat momen seru bareng <span class="text-teal-400 font-extrabold">Lokalify</span> hari ini.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2.5 w-full md:w-auto pt-2 md:pt-0 border-t md:border-t-0 border-slate-800/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block md:hidden mb-1">Ikuti Media Sosial Kami:</span>
                        
                        <div class="flex items-center gap-2.5 w-full sm:w-auto">
                            <a href="https://www.tiktok.com/@brokolii_047?is_from_webapp=1&sender_device=pc" target="_blank" class="btn-micro flex-1 sm:flex-initial flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900/90 hover:bg-black text-slate-200 hover:text-white border border-slate-700/80 hover:border-teal-400/50 shadow-md">
                                <i class="fa-brands fa-tiktok text-sm text-cyan-400"></i>
                                <span class="font-extrabold text-[11px]">TikTok</span>
                            </a>
                            <a href="https://www.instagram.com/hey_nezhh?dlrf=ZWh4ZmxvNW4wbGE2" target="_blank" class="btn-micro flex-1 sm:flex-initial flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900/90 hover:bg-gradient-to-r hover:from-purple-600 hover:to-pink-600 text-slate-200 hover:text-white border border-slate-700/80 hover:border-pink-500/50 shadow-md">
                                <i class="fa-brands fa-instagram text-sm text-pink-400"></i>
                                <span class="font-extrabold text-[11px]">Instagram</span>
                            </a>
                            <a href="https://youtube.com/@lokalify-s4w?si=lq1zJuPyI18qrqrL" target="_blank" class="btn-micro flex-1 sm:flex-initial flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900/90 hover:bg-rose-600 text-slate-200 hover:text-white border border-slate-700/80 hover:border-rose-500/50 shadow-md">
                                <i class="fa-brands fa-youtube text-sm text-rose-500"></i>
                                <span class="font-extrabold text-[11px]">YouTube</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION HEADER: DISCOVER DESTINATIONS -->
            <div class="flex justify-between items-center pt-2">
                <h2 class="text-base font-extrabold text-white tracking-tight">Kategori Wisata</h2>
                <a href="<?php echo e(route('user.dashboard')); ?>" class="btn-micro text-xs font-bold text-teal-400 hover:underline">Show all</a>
            </div>

            <!-- Kategori Filter -->
            <div class="relative flex items-center w-full" x-data="{
                scrollLeft() { $refs.categoryContainer.scrollBy({ left: -300, behavior: 'smooth' }); },
                scrollRight() { $refs.categoryContainer.scrollBy({ left: 300, behavior: 'smooth' }); }
            }">
                <button @click="scrollLeft()" class="btn-micro flex-shrink-0 w-8 h-8 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:bg-teal-500 hover:text-slate-950 flex items-center justify-center shadow-lg mr-2 z-10" title="Geser Kiri">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>

                <div x-ref="categoryContainer" class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar scroll-smooth w-full">
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="btn-micro px-4 py-1.5 rounded-full text-[11px] font-bold whitespace-nowrap <?php echo e(!request('kategori') ? 'bg-teal-500 text-slate-950 shadow-md shadow-teal-500/20' : 'bg-slate-900 text-slate-300 border border-slate-800 hover:border-slate-700'); ?>">Semua Tempat</a>
                    <?php if(isset($kategori)): ?>
                        <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('user.dashboard', ['kategori' => $kat->id])); ?>" class="btn-micro px-4 py-1.5 rounded-full text-[11px] font-bold whitespace-nowrap <?php echo e(request('kategori') == $kat->id ? 'bg-teal-500 text-slate-950 shadow-md shadow-teal-500/20' : 'bg-slate-900 text-slate-300 border border-slate-800 hover:border-slate-700'); ?>"><?php echo e($kat->nama_kategori); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <button @click="scrollRight()" class="btn-micro flex-shrink-0 w-8 h-8 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:bg-teal-500 hover:text-slate-950 flex items-center justify-center shadow-lg ml-2 z-10" title="Geser Kanan">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>

            <!-- SKELETON LOADING STATE -->
            <div x-show="isLoading" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 items-start">
                <template x-for="i in 4" :key="i">
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-3.5 space-y-3 shadow-lg animate-pulse">
                        <div class="w-full aspect-video rounded-xl bg-slate-800"></div>
                        <div class="space-y-2">
                            <div class="h-3.5 bg-slate-800 rounded w-3/4"></div>
                            <div class="h-2.5 bg-slate-800 rounded w-1/2"></div>
                            <div class="h-2 bg-slate-800 rounded w-full"></div>
                        </div>
                        <div class="flex items-center justify-between pt-3 border-t border-slate-800/80">
                            <div class="h-3 bg-slate-800 rounded w-12"></div>
                            <div class="h-6 bg-slate-800 rounded w-20"></div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- GRID KARTU DESTINASI -->
            <div x-show="!isLoading" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 items-start"
            >
                <?php if(isset($destinasi) && count($destinasi) > 0): ?>
                    <?php $__currentLoopData = $destinasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reveal-card bg-slate-900 border border-slate-800 rounded-2xl p-3.5 space-y-3 shadow-lg hover:border-teal-500/50 transition duration-300 flex flex-col justify-between h-full group/card">
                            
                            <div class="space-y-2.5">
                                <div class="relative w-full aspect-video rounded-xl overflow-hidden bg-slate-950">
                                    <?php if(!empty($item->foto)): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->foto)); ?>" alt="<?php echo e($item->nama_destinasi); ?>" class="w-full h-full object-cover group-hover/card:scale-105 transition duration-500 ease-out">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-teal-500 to-blue-600 flex items-center justify-center text-slate-950 font-bold group-hover/card:scale-105 transition duration-500 ease-out">
                                            <i class="fa-solid fa-mountain-sun text-2xl"></i>
                                        </div>
                                    <?php endif; ?>
                                    <span class="absolute top-2 left-2 bg-slate-950/80 backdrop-blur px-2 py-0.5 rounded-lg text-[9px] font-extrabold text-teal-400 border border-slate-800">
                                        <?php echo e($item->kategori->nama_kategori ?? 'Wisata'); ?>

                                    </span>
                                </div>

                                <div class="space-y-1">
                                    <h3 class="font-extrabold text-white text-xs group-hover/card:text-teal-400 transition"><?php echo e($item->nama_destinasi); ?></h3>
                                    <p class="text-[10px] text-slate-400 flex items-center space-x-1">
                                        <i class="fa-solid fa-location-dot text-teal-400 text-[9px]"></i>
                                        <span><?php echo e($item->alamat ?? 'Ciwidey, Bandung'); ?></span>
                                    </p>

                                    <?php if($item->deskripsi_singkat): ?>
                                        <p class="text-[10px] text-teal-300/90 mt-1.5 italic leading-relaxed">
                                            "<?php echo e($item->deskripsi_singkat); ?>"
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php
                                $totalReviews = $item->reviews ? $item->reviews->count() : 0;
                                $avgRating = $totalReviews > 0 ? round($item->reviews->avg('rating'), 1) : 0;
                            ?>

                            <div class="flex items-center justify-between pt-3 border-t border-slate-800/80 mt-2">
                                <div class="flex items-center space-x-1 text-amber-400 font-bold text-[10px]">
                                    <i class="fa-solid fa-star text-[9px]"></i>
                                    <span><?php echo e(number_format($avgRating, 1)); ?></span>
                                    <span class="text-slate-500 font-normal">(<?php echo e($totalReviews); ?>)</span>
                                </div>
                                <a href="<?php echo e(route('user.destinasi.detail', $item->id)); ?>" 
                                   @click.prevent="navigateWithExit($event)"
                                   class="btn-micro px-3 py-1 bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold rounded-lg text-[10px]"
                                >
                                    Detail Wisata ↗
                                </a>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-span-full py-12 text-center bg-slate-900 rounded-2xl border border-slate-800">
                        <p class="text-xs text-slate-400 font-semibold">Belum ada destinasi wisata di database.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- MODAL POP-UP LEADERBOARD WISATA TERBAIK -->
    <?php
        // Hitung skor leaderboard tanpa mengubah properti objek destinasi.
        // Persentase = total bintang / (jumlah ulasan x 5) x 100.
        $leaderboardWisata = collect($destinasi ?? [])
            ->filter(function ($wisata) {
                return is_object($wisata) && isset($wisata->id);
            })
            ->map(function ($wisata) {
                $ulasan = $wisata->reviews ?? collect();
                $jumlahUlasan = $ulasan->count();
                $totalBintang = $ulasan->sum('rating');

                return (object) [
                    'destinasi' => $wisata,
                    'total_ulasan' => $jumlahUlasan,
                    'total_bintang' => $totalBintang,
                    'persentase' => $jumlahUlasan > 0
                        ? ($totalBintang / ($jumlahUlasan * 5)) * 100
                        : 0,
                    'rating' => $jumlahUlasan > 0
                        ? $totalBintang / $jumlahUlasan
                        : 0,
                ];
            })
            ->sort(function ($a, $b) {
                $bedaPersentase = $b->persentase <=> $a->persentase;
                if ($bedaPersentase !== 0) {
                    return $bedaPersentase;
                }
                return $b->total_ulasan <=> $a->total_ulasan;
            })
            ->take(10)
            ->values();
    ?>

    <div x-cloak x-show="leaderboardModalOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="leaderboardModalOpen = false"
         class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6 bg-slate-950/80 backdrop-blur-md"
         style="display:none;"
         role="dialog" aria-modal="true" aria-labelledby="leaderboard-title">
        <div @click.outside="leaderboardModalOpen = false"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             class="w-full max-w-4xl max-h-[90vh] overflow-hidden rounded-3xl bg-slate-900 border border-slate-700/80 shadow-2xl shadow-teal-950/30 flex flex-col">

            <div class="relative overflow-hidden flex-shrink-0 p-5 sm:p-6 bg-gradient-to-r from-[#07162d] via-[#0a233c] to-slate-900 border-b border-slate-800">
                <div class="absolute -top-12 -right-8 w-44 h-44 rounded-full bg-teal-500/10 blur-3xl pointer-events-none"></div>
                <div class="relative flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-teal-500/15 border border-teal-400/20 text-teal-300 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-[0.2em] text-teal-400 font-extrabold mb-1">LOKALIFY • DESTINATION AWARDS</p>
                            <h2 id="leaderboard-title" class="text-lg sm:text-xl font-black text-white">Leaderboard Wisata Terbaik</h2>
                            <p class="text-[11px] sm:text-xs text-slate-400 mt-1">10 destinasi teratas berdasarkan persentase rating dari seluruh ulasan.</p>
                        </div>
                    </div>
                    <button type="button" @click="leaderboardModalOpen = false" aria-label="Tutup leaderboard"
                            class="btn-micro w-9 h-9 rounded-xl bg-slate-800 hover:bg-rose-500/15 text-slate-400 hover:text-rose-300 border border-slate-700 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="relative mt-4 flex flex-wrap gap-2 text-[10px] font-semibold">
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 bg-teal-500/10 border border-teal-500/20 text-teal-300"><i class="fa-solid fa-chart-line"></i> Skor berdasarkan persentase bintang</span>
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 bg-slate-800/80 border border-slate-700 text-slate-300"><i class="fa-solid fa-star text-amber-400"></i> Maksimal 100%</span>
                </div>
            </div>

            <div class="overflow-y-auto p-3 sm:p-5 space-y-2.5">
                <?php $__empty_1 = true; $__currentLoopData = $leaderboardWisata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $wisata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="group flex items-center gap-3 sm:gap-4 p-3 sm:p-4 rounded-2xl bg-slate-950/60 border border-slate-800 hover:border-teal-500/40 hover:bg-slate-800/60 transition duration-200">
                        <div class="w-8 sm:w-10 flex-shrink-0 text-center">
                            <?php if($index === 0): ?>
                                <div class="w-8 h-8 sm:w-10 sm:h-10 mx-auto rounded-xl bg-amber-400/15 border border-amber-400/30 text-amber-300 flex items-center justify-center font-black"><i class="fa-solid fa-crown"></i></div>
                            <?php elseif($index === 1): ?>
                                <div class="w-8 h-8 sm:w-10 sm:h-10 mx-auto rounded-xl bg-slate-300/10 border border-slate-300/20 text-slate-200 flex items-center justify-center font-black">2</div>
                            <?php elseif($index === 2): ?>
                                <div class="w-8 h-8 sm:w-10 sm:h-10 mx-auto rounded-xl bg-orange-500/10 border border-orange-400/20 text-orange-300 flex items-center justify-center font-black">3</div>
                            <?php else: ?>
                                <span class="text-sm font-black text-slate-500"><?php echo e(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="w-16 h-14 sm:w-24 sm:h-16 rounded-xl overflow-hidden bg-slate-800 border border-slate-700 flex-shrink-0">
                            <?php if(!empty($wisata->destinasi->foto)): ?>
                                <img src="<?php echo e(asset('storage/' . $wisata->destinasi->foto)); ?>" alt="<?php echo e($wisata->destinasi->nama_destinasi); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-teal-400"><i class="fa-solid fa-mountain-sun text-xl"></i></div>
                            <?php endif; ?>
                        </div>

                        <div class="min-w-0 flex-1">
                            <h3 class="text-xs sm:text-sm font-extrabold text-white truncate group-hover:text-teal-300 transition"><?php echo e($wisata->destinasi->nama_destinasi); ?></h3>
                            <p class="text-[10px] text-slate-500 truncate mt-1"><i class="fa-solid fa-location-dot text-teal-500 mr-1"></i><?php echo e($wisata->destinasi->alamat ?? 'Lokasi belum tersedia'); ?></p>
                            <div class="mt-2 flex items-center gap-3 flex-wrap text-[10px]">
                                <span class="text-amber-400 font-bold"><i class="fa-solid fa-star mr-1"></i><?php echo e(number_format($wisata->rating, 1)); ?>/5</span>
                                <span class="text-slate-400"><i class="fa-regular fa-comment-dots mr-1"></i><?php echo e(number_format($wisata->total_ulasan)); ?> ulasan</span>
                            </div>
                        </div>

                        <div class="w-20 sm:w-32 flex-shrink-0 text-right">
                            <p class="text-sm sm:text-base font-black <?php echo e($index === 0 ? 'text-teal-300' : 'text-white'); ?>"><?php echo e(number_format($wisata->persentase, 1)); ?>%</p>
                            <div class="h-1.5 sm:h-2 mt-2 rounded-full bg-slate-800 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-teal-500 to-emerald-300" style="width: <?php echo e(min(100, max(0, $wisata->persentase))); ?>%"></div>
                            </div>
                            <p class="hidden sm:block text-[9px] text-slate-500 mt-1"><?php echo e(number_format($wisata->total_bintang)); ?> dari <?php echo e($wisata->total_ulasan * 5); ?> bintang</p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="py-12 text-center rounded-2xl bg-slate-950/50 border border-dashed border-slate-700">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-slate-800 text-slate-500 flex items-center justify-center text-xl mb-3"><i class="fa-solid fa-trophy"></i></div>
                        <h3 class="text-sm font-extrabold text-white">Belum ada destinasi wisata</h3>
                        <p class="text-xs text-slate-400 mt-1">Destinasi yang tersedia akan muncul di leaderboard ini.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex-shrink-0 flex items-center justify-between gap-3 p-4 sm:px-6 border-t border-slate-800 bg-slate-950/70">
                <p class="text-[9px] sm:text-[10px] text-slate-500 leading-relaxed">Rumus: total bintang ÷ (jumlah ulasan × 5) × 100%.</p>
                <button type="button" @click="leaderboardModalOpen = false" class="btn-micro px-4 py-2 rounded-xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold text-xs flex-shrink-0">Selesai</button>
            </div>
        </div>
    </div>

    <!-- MODAL POP-UP BISNIS LOKALIFY -->
    <div x-show="bisnisModalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-50 flex items-center justify-center p-4"
         style="display: none;"
    >
        <div @click.outside="bisnisModalOpen = false" 
             class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-2xl max-h-[90vh] flex flex-col shadow-2xl overflow-hidden glow-teal animate-hero-entry"
        >
            <!-- Header Modal -->
            <div class="bg-gradient-to-r from-slate-900 via-[#07162d] to-slate-900 border-b border-slate-800 p-5 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-teal-500 text-slate-950 flex items-center justify-center font-black text-sm shadow-lg shadow-teal-500/20">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                <div>
                        <h3 class="font-black text-white text-sm">Kemitraan Bisnis Lokalify</h3>
                        <p class="text-[10px] text-teal-400 font-semibold">Pusat Layanan Promosi Destinasi Wisata</p>
                    </div>
                </div>
                <button @click="bisnisModalOpen = false" class="btn-micro w-8 h-8 rounded-xl bg-slate-800 text-slate-400 hover:text-white flex items-center justify-center border border-slate-700">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Konten Modal yang Dapat Di-scroll -->
            <div class="p-6 space-y-6 overflow-y-auto no-scrollbar text-xs">
                
                <!-- Hero Text / Sambutan -->
                <div class="space-y-2 bg-slate-800/50 border border-slate-800 rounded-2xl p-4">
                    <h4 class="font-extrabold text-teal-400 text-sm tracking-tight">Jadikan Destinasi Wisatamu Lebih Dikenal!</h4>
                    <p class="text-slate-300 leading-relaxed text-[11px]">
                        Promosikan tempat wisatamu melalui <strong class="text-white">LOKALIFY</strong>. Jangkau lebih banyak calon pengunjung, tampilkan informasi destinasi secara lengkap, dan bantu wisatawan menemukan tempat terbaik untuk petualangan mereka.
                    </p>
                </div>

                <!-- Syarat Menambahkan Wisata -->
                <div class="space-y-3">
                    <h5 class="font-extrabold text-white uppercase tracking-wider text-[11px] flex items-center gap-2 border-b border-slate-800 pb-2">
                        <i class="fa-solid fa-clipboard-check text-teal-400"></i> Syarat Menambahkan Wisata
                    </h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="bg-slate-800/40 border border-slate-800 p-3 rounded-xl space-y-1">
                            <span class="text-[10px] font-black text-teal-400">01</span>
                            <h6 class="font-bold text-white text-[11px]">Memiliki Destinasi Wisata yang Jelas</h6>
                            <p class="text-slate-400 text-[10px] leading-relaxed">Destinasi harus benar-benar ada dan dapat dikunjungi atau diverifikasi keberadaannya.</p>
                        </div>
                        <div class="bg-slate-800/40 border border-slate-800 p-3 rounded-xl space-y-1">
                            <span class="text-[10px] font-black text-teal-400">02</span>
                            <h6 class="font-bold text-white text-[11px]">Mengisi Informasi Secara Lengkap</h6>
                            <p class="text-slate-400 text-[10px] leading-relaxed">Cantumkan nama wisata, alamat, deskripsi, fasilitas, daya tarik, dan informasi pendukung lainnya.</p>
                        </div>
                        <div class="bg-slate-800/40 border border-slate-800 p-3 rounded-xl space-y-1">
                            <span class="text-[10px] font-black text-teal-400">03</span>
                            <h6 class="font-bold text-white text-[11px]">Menggunakan Foto yang Sesuai</h6>
                            <p class="text-slate-400 text-[10px] leading-relaxed">Unggah foto asli atau foto yang memiliki izin penggunaan dan menggambarkan kondisi destinasi.</p>
                        </div>
                        <div class="bg-slate-800/40 border border-slate-800 p-3 rounded-xl space-y-1">
                            <span class="text-[10px] font-black text-teal-400">04</span>
                            <h6 class="font-bold text-white text-[11px]">Memberikan Informasi yang Akurat</h6>
                            <p class="text-slate-400 text-[10px] leading-relaxed">Pastikan informasi harga tiket, jam operasional, fasilitas, dan lokasi sesuai kondisi sebenarnya.</p>
                        </div>
                    </div>
                    <div class="bg-slate-800/40 border border-slate-800 p-3 rounded-xl space-y-1">
                        <span class="text-[10px] font-black text-teal-400">05</span>
                        <h6 class="font-bold text-white text-[11px]">Menyetujui Proses Verifikasi</h6>
                        <p class="text-slate-400 text-[10px] leading-relaxed">Bersedia mengikuti pemeriksaan oleh tim LOKALIFY sebelum destinasi ditampilkan secara publik.</p>
                    </div>
                </div>

                <!-- Keuntungan Bergabung dengan LOKALIFY -->
                <div class="space-y-3">
                    <h5 class="font-extrabold text-white uppercase tracking-wider text-[11px] flex items-center gap-2 border-b border-slate-800 pb-2">
                        <i class="fa-solid fa-chart-line text-teal-400"></i> Keuntungan Bergabung dengan LOKALIFY
                    </h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="bg-slate-800/40 border border-slate-800 p-3 rounded-xl space-y-1">
                            <h6 class="font-bold text-teal-300 text-[11px]">Jangkauan Pengunjung Lebih Luas</h6>
                            <p class="text-slate-400 text-[10px] leading-relaxed">Bantu lebih banyak wisatawan menemukan destinasi yang kamu kelola melalui platform informasi wisata.</p>
                        </div>
                        <div class="bg-slate-800/40 border border-slate-800 p-3 rounded-xl space-y-1">
                            <h6 class="font-bold text-teal-300 text-[11px]">Promosi Destinasi Lebih Informatif</h6>
                            <p class="text-slate-400 text-[10px] leading-relaxed">Tampilkan foto, deskripsi, daya tarik, fasilitas, lokasi, dan informasi penting dalam satu halaman.</p>
                        </div>
                        <div class="bg-slate-800/40 border border-slate-800 p-3 rounded-xl space-y-1">
                            <h6 class="font-bold text-teal-300 text-[11px]">Mudah Ditemukan Wisatawan</h6>
                            <p class="text-slate-400 text-[10px] leading-relaxed">Bantu calon pengunjung mengenal destinasi dan merencanakan perjalanan mereka.</p>
                        </div>
                        <div class="bg-slate-800/40 border border-slate-800 p-3 rounded-xl space-y-1">
                            <h6 class="font-bold text-teal-300 text-[11px]">Kelola Informasi Destinasi</h6>
                            <p class="text-slate-400 text-[10px] leading-relaxed">Perbarui informasi wisata agar pengunjung memperoleh informasi yang relevan dan terkini.</p>
                        </div>
                    </div>
                </div>

                <!-- Tombol WhatsApp Pilihan -->
                <div class="pt-4 border-t border-slate-800 space-y-3">
                    <p class="text-center font-bold text-slate-300 text-[11px]">Silakan hubungi tim kami melalui WhatsApp untuk melanjutkan proses pendaftaran bisnis:</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Despian Ananda -->
                        <a href="https://wa.me/628981345475?text=Halo%20Despian%20Ananda,%20saya%20ingin%20mendaftarkan%20destinasi%20wisata%20saya%20di%20Lokalify." 
                           target="_blank" 
                           class="btn-micro flex items-center justify-center gap-2.5 p-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold shadow-lg shadow-emerald-600/20 transition"
                        >
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <div class="text-left">
                                <p class="text-[11px] font-black leading-tight">Despian Ananda</p>
                                <p class="text-[10px] font-normal text-emerald-100">+62 898-1345-475</p>
                            </div>
                        </a>

                        <!-- Irvan Zainudin Ilham -->
                        <a href="https://wa.me/6283834041347?text=Halo%20Irvan%20Zainudin%20Ilham,%20saya%20ingin%20mendaftarkan%20destinasi%20wisata%20saya%20di%20Lokalify." 
                           target="_blank" 
                           class="btn-micro flex items-center justify-center gap-2.5 p-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold shadow-lg shadow-emerald-600/20 transition"
                        >
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <div class="text-left">
                                <p class="text-[11px] font-black leading-tight">Irvan Zainudin Ilham</p>
                                <p class="text-[10px] font-normal text-emerald-100">+62 838-3404-1347</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- FLOATING AI GEMINI BUTTON & CHATBOX -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
        <div x-show="aiOpen" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-6 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             class="mb-4 w-80 md:w-96 bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden flex flex-col h-[450px] glow-teal"
             style="display: none;"
        >
            <div class="bg-[#07162d] border-b border-slate-800 p-3.5 flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <div class="w-7 h-7 rounded-lg bg-teal-500/20 text-teal-400 flex items-center justify-center font-bold text-xs border border-teal-500/30">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-white text-xs">Lokalify AI Assistant</h4>
                        <p class="text-[9px] text-teal-400">Powered by Denz AI</p>
                    </div>
                </div>
                <button @click="aiOpen = false" class="btn-micro text-slate-400 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <div id="aiChatBox" class="flex-1 p-3.5 overflow-y-auto space-y-3 text-xs no-scrollbar">
                <div class="bg-slate-800/80 border border-slate-700/60 rounded-xl p-3 text-slate-200 max-w-[85%] leading-relaxed animate-hero-entry">
                    Halo <?php echo e(auth()->user()->name ?? 'Petualang'); ?>! ✨<br>
                    Ada yang ingin kamu tanyakan seputar destinasi wisata, rekomendasi tempat liburan, atau penginapan? 💡🚀
                </div>
            </div>

            <div class="p-3 border-t border-slate-800 bg-slate-900/90">
                <form id="aiChatForm" class="flex items-center gap-2" onsubmit="handleSendAiMessage(event)">
                    <input 
                        type="text" 
                        id="aiInput" 
                        placeholder="Tanyakan sesuatu..." 
                        class="flex-1 bg-slate-800 border border-slate-700 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-teal-500 transition-all"
                        required
                    >
                    <button type="submit" id="aiSendBtn" class="btn-micro bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold px-3 py-2 rounded-xl text-xs flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <button 
            @click="aiOpen = !aiOpen"
            class="animate-float-ai btn-micro flex items-center gap-2.5 px-4 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-400 hover:to-emerald-400 text-slate-950 font-extrabold rounded-full shadow-2xl shadow-teal-500/30 transition transform hover:scale-105"
            title="Tanya AI Lokalify"
        >
            <i class="fa-solid fa-wand-magic-sparkles text-sm"></i>
            <span class="text-xs tracking-wide">LOKALIFY AI</span>
        </button>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = { threshold: 0.1 };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-card').forEach(el => observer.observe(el));
        });

        let chatHistory = [];

        async function handleSendAiMessage(event) {
            event.preventDefault();

            const inputEl = document.getElementById('aiInput');
            const chatBox = document.getElementById('aiChatBox');
            const sendBtn = document.getElementById('aiSendBtn');
            const userMessage = inputEl.value.trim();

            if (!userMessage || sendBtn.disabled) return;

            const userBubble = document.createElement('div');
            userBubble.className = 'flex justify-end animate-hero-entry';
            const userText = document.createElement('div');
            userText.className = 'bg-teal-500 text-slate-950 font-medium rounded-xl p-3 max-w-[85%] leading-relaxed';
            userText.textContent = userMessage;
            userBubble.appendChild(userText);
            chatBox.appendChild(userBubble);

            inputEl.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            const loadingEl = document.createElement('div');
            loadingEl.className = 'bg-slate-800/80 border border-slate-700/60 rounded-xl p-3 text-slate-400 max-w-[85%] flex items-center gap-2 animate-hero-entry';
            loadingEl.innerHTML = `
                <span class="text-xs text-teal-400 font-semibold mr-1">Lokalify AI</span>
                <div class="flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-teal-400 rounded-full typing-dot"></span>
                    <span class="w-1.5 h-1.5 bg-teal-400 rounded-full typing-dot"></span>
                    <span class="w-1.5 h-1.5 bg-teal-400 rounded-full typing-dot"></span>
                </div>
            `;
            chatBox.appendChild(loadingEl);
            chatBox.scrollTop = chatBox.scrollHeight;
            sendBtn.disabled = true;
            sendBtn.classList.add('opacity-60', 'cursor-not-allowed');

            try {
                const response = await fetch(<?php echo json_encode(route('user.ai.chat'), 15, 512) ?>, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': <?php echo json_encode(csrf_token(), 15, 512) ?>
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        message: userMessage,
                        history: chatHistory
                    })
                });

                const data = await response.json().catch(() => ({}));
                loadingEl.remove();

                if (!response.ok) {
                    throw new Error(data.message || 'AI belum dapat menjawab.');
                }

                const aiReply = data.reply || 'Maaf, AI belum memberikan jawaban.';

                chatHistory.push({ role: 'user', text: userMessage });
                chatHistory.push({ role: 'model', text: aiReply });

                const replyEl = document.createElement('div');
                replyEl.className = 'bg-slate-800/80 border border-slate-700/60 rounded-xl p-3 text-slate-200 max-w-[85%] leading-relaxed animate-hero-entry';
                replyEl.textContent = aiReply;
                replyEl.style.whiteSpace = 'pre-wrap';
                chatBox.appendChild(replyEl);
            } catch (error) {
                if (loadingEl.isConnected) loadingEl.remove();
                const errorEl = document.createElement('div');
                errorEl.className = 'bg-rose-950/50 border border-rose-800/50 rounded-xl p-3 text-rose-300 max-w-[85%] animate-hero-entry';
                errorEl.textContent = error.message || 'Terjadi kesalahan koneksi.';
                chatBox.appendChild(errorEl);
            } finally {
                sendBtn.disabled = false;
                sendBtn.classList.remove('opacity-60', 'cursor-not-allowed');
                chatBox.scrollTop = chatBox.scrollHeight;
                inputEl.focus();
            }
        }
    </script>
</body>
</html><?php /**PATH C:\Users\Administrator\Desktop\Lokalify\resources\views/user/dashboard.blade.php ENDPATH**/ ?>