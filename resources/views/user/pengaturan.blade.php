<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - Lokalify 📍</title>
    <!-- Tailwind CSS CDN & Font Plus Jakarta Sans -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <a href="{{ route('user.wishlist') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/60 rounded-xl">
                    <i class="fa-solid fa-heart text-rose-400 text-sm w-5 text-center"></i>
                    <span>My Wishlist</span>
                </a>
                <a href="{{ route('user.pengaturan') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-bold bg-teal-500/10 text-teal-400 border border-teal-500/30 rounded-xl">
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
                    <i class="fa-solid fa-gear text-teal-400"></i>
                    <span class="truncate">Pengaturan Akun & Bantuan</span>
                </h2>
            </div>
        </header>

        <!-- KONTEN PENGATURAN -->
        <main class="p-4 sm:p-6 max-w-3xl space-y-5 flex-1 mx-auto w-full animate-hero-entry">
            
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="bg-teal-500/10 border border-teal-500/30 text-teal-300 px-4 py-3 rounded-2xl text-xs font-semibold flex items-center justify-between">
                    <span class="flex items-center gap-2 truncate">
                        <i class="fa-solid fa-circle-check text-teal-400 flex-shrink-0"></i>
                        <span class="truncate">{{ session('success') }}</span>
                    </span>
                </div>
            @endif

            {{-- Notifikasi Error --}}
            @if ($errors->any())
                <div class="bg-rose-500/10 border border-rose-500/30 text-rose-300 px-4 py-3 rounded-2xl text-xs space-y-1">
                    <p class="font-bold flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-rose-400 flex-shrink-0"></i>
                        Terjadi kesalahan:
                    </p>
                    <ul class="list-disc list-inside pl-2 text-slate-300">
                        @foreach ($errors->all() as $error)
                            <li class="truncate">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- KOTAK 1: Informasi Profil & Kata Sandi -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 sm:p-6 shadow-lg space-y-4">
                <div class="border-b border-slate-800 pb-3">
                    <h3 class="text-xs sm:text-sm font-bold text-white tracking-tight">Informasi Profil & Kata Sandi</h3>
                    <p class="text-slate-400 text-[10px] sm:text-[11px] mt-0.5">Perbarui informasi akun dan ubah kata sandi Anda di sini.</p>
                </div>

                <form action="{{ route('user.pengaturan.profile') }}" method="POST" class="space-y-3.5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-teal-500">
                    </div>

                    <div class="pt-3 border-t border-slate-800 space-y-3">
                        <h4 class="text-[11px] font-extrabold text-teal-400 uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-lock text-xs"></i>
                            Ubah Kata Sandi (Opsional)
                        </h4>
                        
                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Kata Sandi Baru</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-teal-500">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-teal-500">
                        </div>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="btn-micro w-full sm:w-auto px-5 py-2.5 bg-teal-500 hover:bg-teal-400 text-slate-950 font-bold rounded-xl text-xs shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- KOTAK 2: Form Laporan Bug -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 sm:p-6 shadow-lg space-y-4">
                <div class="border-b border-slate-800 pb-3">
                    <h3 class="text-xs sm:text-sm font-bold text-white tracking-tight flex items-center gap-2">
                        <i class="fa-solid fa-bug text-rose-400"></i>
                        <span>Laporkan Bug / Kendala Sistem</span>
                    </h3>
                    <p class="text-slate-400 text-[10px] sm:text-[11px] mt-0.5">Temukan masalah atau error? Kirimkan laporan beserta foto bukti kepada pengembang.</p>
                </div>

                <form action="{{ route('user.pengaturan.bug') }}" method="POST" enctype="multipart/form-data" class="space-y-3.5">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Upload Bukti Tangkapan Layar / Foto Bug</label>
                        <input type="file" name="foto" accept="image/*" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-slate-800 file:text-teal-400 cursor-pointer">
                        <p class="text-[10px] text-slate-500 mt-1">*Format: JPG, PNG (Maks. 5MB)</p>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Detail Pesan / Penjelasan Bug</label>
                        <textarea name="pesan" rows="3" required placeholder="Jelaskan kendala yang Anda alami secara detail..." class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-teal-500"></textarea>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="btn-micro w-full sm:w-auto px-5 py-2.5 bg-rose-500 hover:bg-rose-400 text-white font-bold rounded-xl text-xs shadow-md">
                            Kirim Laporan Bug
                        </button>
                    </div>
                </form>
            </div>

            <!-- KOTAK 3: Riwayat Laporan Bug -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 sm:p-6 shadow-lg space-y-4">
                <div class="border-b border-slate-800 pb-3">
                    <h3 class="text-xs sm:text-sm font-bold text-white tracking-tight flex items-center gap-2">
                        <i class="fa-solid fa-clipboard-list text-teal-400"></i>
                        <span>Riwayat Laporan & Tanggapan Admin</span>
                    </h3>
                    <p class="text-slate-400 text-[10px] sm:text-[11px] mt-0.5">Daftar laporan kendala yang pernah Anda kirim beserta status dan jawabannya.</p>
                </div>

                <div class="space-y-3">
                    @forelse($riwayatLaporan ?? [] as $lap)
                        <div class="bg-slate-950 border border-slate-800 p-3.5 sm:p-4 rounded-2xl space-y-2.5">
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-[10px] text-slate-400">{{ $lap->created_at->format('d M Y, H:i') }}</span>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold flex-shrink-0 {{ $lap->status == 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' }}">
                                    {{ ucfirst($lap->status) }}
                                </span>
                            </div>

                            <div>
                                <p class="text-[11px] font-bold text-slate-300">Pesan Anda:</p>
                                <p class="text-xs text-slate-200 mt-0.5 leading-relaxed break-words">{{ $lap->pesan }}</p>
                            </div>

                            @if($lap->foto)
                                <div>
                                    <p class="text-[11px] font-bold text-slate-300 mb-1">Bukti Foto:</p>
                                    <img src="{{ asset('storage/' . $lap->foto) }}" loading="lazy" alt="Foto Bukti" class="w-20 h-20 object-cover rounded-xl border border-slate-800">
                                </div>
                            @endif

                            <div class="pt-2.5 border-t border-slate-800 space-y-1">
                                <p class="text-[11px] font-bold text-teal-400 flex items-center gap-1.5">
                                    <i class="fa-solid fa-reply text-[10px]"></i>
                                    Jawaban Admin:
                                </p>
                                @if($lap->jawaban)
                                    <p class="text-xs text-slate-200 mt-1 bg-teal-500/5 border border-teal-500/20 p-2.5 rounded-xl leading-relaxed break-words">{{ $lap->jawaban }}</p>
                                @else
                                    <p class="text-xs text-slate-500 italic mt-0.5">Belum ada tanggapan dari admin.</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center rounded-2xl bg-slate-950/40 border border-dashed border-slate-800">
                            <p class="text-xs text-slate-400 italic">Belum ada riwayat laporan yang dikirim.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </main>
    </div>
</body>
</html>