<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $destinasi->nama_destinasi }} - Detail Destinasi 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #030712;
            color: #f3f4f6;
        }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #090d16; }
        ::-webkit-scrollbar-thumb { background: #1f293d; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #14b8a6; }

        @keyframes pageEntry {
            0% { opacity: 0; transform: translateY(20px) scale(0.98); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes pageExit {
            0% { opacity: 1; transform: translateY(0) scale(1); filter: blur(0px); }
            100% { opacity: 0; transform: translateY(20px) scale(0.97); filter: blur(4px); }
        }
        .anim-page-entry {
            animation: pageEntry 300ms cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .anim-page-exit {
            animation: pageExit 250ms cubic-bezier(0.4, 0, 1, 1) forwards !important;
        }

        @keyframes heroZoom {
            0% { transform: scale(1.15); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        .anim-hero-zoom {
            animation: heroZoom 600ms cubic-bezier(0.16, 1, 0.3, 1) 100ms forwards;
            will-change: transform, opacity;
        }

        @keyframes staggerItem {
            0% { opacity: 0; transform: translateY(12px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .anim-stagger-1 { animation: staggerItem 400ms ease-out 150ms forwards; opacity: 0; }
        .anim-stagger-2 { animation: staggerItem 400ms ease-out 300ms forwards; opacity: 0; }
        .anim-stagger-3 { animation: staggerItem 400ms ease-out 450ms forwards; opacity: 0; }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 600ms cubic-bezier(0.16, 1, 0.3, 1), transform 600ms cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .glow-teal {
            box-shadow: 0 20px 50px -10px rgba(20, 184, 166, 0.12);
        }
        .btn-micro {
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-micro:active {
            transform: scale(0.95) !important;
        }
    </style>
</head>
<body class="bg-[#030712] text-slate-100 min-h-screen flex items-center justify-center p-4 text-xs antialiased selection:bg-teal-500 selection:text-slate-950">

    <div id="mainCard" class="anim-page-entry bg-slate-900/90 border border-slate-800/80 w-full max-w-2xl rounded-3xl overflow-hidden shadow-2xl relative space-y-6 p-6 md:p-8 my-6 backdrop-blur-xl glow-teal">
        
        @if(session('success'))
            <div class="bg-teal-500/10 border border-teal-500/30 text-teal-300 p-3.5 rounded-2xl text-xs flex items-center space-x-2.5 shadow-sm">
                <i class="fa-solid fa-circle-check text-teal-400"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            // Menampilkan pesan error validasi (termasuk error komentar dari server)
            <div class="bg-rose-500/10 border border-rose-500/30 text-rose-300 p-3.5 rounded-2xl text-xs space-y-1.5 shadow-sm">
                @foreach ($errors->all() as $error)
                    <p class="flex items-center space-x-2">
                        <i class="fa-solid fa-circle-exclamation text-rose-400"></i>
                        <span class="font-medium">{{ $error }}</span>
                    </p>
                @endforeach
            </div>
        @endif

        <div class="absolute top-5 right-5 flex items-center space-x-2 z-20">
            <button onclick="openReportModal()" class="btn-micro h-8 px-3.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 flex items-center space-x-1.5 transition border border-rose-500/20 text-[11px] font-bold shadow-sm" title="Laporkan Destinasi">
                <i class="fa-solid fa-flag text-[10px]"></i>
                <span>Lapor</span>
            </button>
            <a href="{{ route('user.dashboard') }}" onclick="handleBackWithAnimation(event, this.href)" class="btn-micro w-8 h-8 rounded-xl bg-slate-800/80 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition border border-slate-700 shadow-sm" title="Kembali">
                <i class="fa-solid fa-xmark text-xs"></i>
            </a>
        </div>

        <div class="relative w-full h-72 rounded-2xl overflow-hidden bg-slate-950 border border-slate-800 shadow-inner">
            @if($destinasi->foto)
                <img src="{{ asset('storage/' . $destinasi->foto) }}" alt="{{ $destinasi->nama_destinasi }}" class="anim-hero-zoom w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-6xl anim-hero-zoom bg-slate-900 text-teal-400">
                    <i class="fa-solid fa-mountain-sun"></i>
                </div>
            @endif
            
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-50"></div>

            <span class="absolute top-3.5 left-3.5 bg-slate-950/80 backdrop-blur-md px-3 py-1 rounded-xl text-xs font-bold text-teal-300 border border-slate-700/60 shadow-md z-10">
                {{ $destinasi->kategori->nama_kategori ?? 'Wisata' }}
            </span>

            <form action="{{ route('user.wishlist.toggle', $destinasi->id) }}" method="POST" class="absolute top-3.5 right-16 z-10">
                @csrf
                <button type="submit" class="btn-micro w-9 h-9 rounded-xl bg-slate-950/80 backdrop-blur-md border border-slate-700/60 flex items-center justify-center transition shadow-lg group" title="Wishlist">
                    @if(isset($isWishlist) && $isWishlist)
                        <i class="fa-solid fa-heart text-rose-500 text-sm scale-110 transition"></i>
                    @else
                        <i class="fa-regular fa-heart text-slate-300 group-hover:text-rose-400 text-sm transition"></i>
                    @endif
                </button>
            </form>
        </div>

        <div class="anim-stagger-1 space-y-2">
            <h2 class="text-xl md:text-2xl font-black text-white tracking-tight">{{ $destinasi->nama_destinasi }}</h2>
            <p class="text-xs text-teal-400 font-semibold flex items-center space-x-1.5">
                <i class="fa-solid fa-location-dot"></i>
                <span>{{ $destinasi->alamat ?? 'Lokasi tidak tersedia' }}</span>
            </p>
            @if($destinasi->jam_buka)
                <p class="text-[11px] text-slate-400 flex items-center space-x-1.5">
                    <i class="fa-regular fa-clock text-teal-400"></i>
                    <span>Jam Operasional: {{ $destinasi->jam_buka }}</span>
                </p>
            @endif
        </div>

        @if($destinasi->deskripsi_singkat)
            <div class="anim-stagger-2 bg-teal-500/10 border border-teal-500/20 p-4 rounded-2xl space-y-1.5 shadow-sm">
                <h4 class="font-extrabold text-teal-300 text-xs uppercase tracking-wider">Highlight / Profil Singkat</h4>
                <p class="text-xs text-slate-300 leading-relaxed">{{ $destinasi->deskripsi_singkat }}</p>
            </div>
        @endif

        <div class="anim-stagger-3 space-y-2 bg-slate-950/60 p-4.5 rounded-2xl border border-slate-800/80 shadow-sm">
            <h3 class="font-extrabold text-slate-200 text-xs uppercase tracking-wider">Detail Lengkap & Fasilitas</h3>
            <p class="text-xs text-slate-300 leading-relaxed font-normal whitespace-pre-line">
                {{ $destinasi->deskripsi_lengkap ?? $destinasi->deskripsi ?? 'Belum ada detail penjelasan.' }}
            </p>
        </div>

        @php
            $galeriItems = $destinasi->galeri ?? collect();
        @endphp
        <div class="scroll-reveal space-y-3.5 pt-2">
            <div class="flex justify-between items-center border-b border-slate-800 pb-2.5">
                <h3 class="font-extrabold text-white text-xs flex items-center space-x-2">
                    <i class="fa-solid fa-images text-teal-400"></i>
                    <span>Galeri Wisatawan</span>
                </h3>
                <span class="text-[10px] text-slate-400">Foto & Video dari Pengguna</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 max-h-64 overflow-y-auto no-scrollbar">
                @forelse ($galeriItems as $index => $g)
                    <div onclick="openMediaModal({{ $index }})" 
                         class="btn-micro relative group rounded-xl overflow-hidden bg-slate-950 border border-slate-800 h-28 cursor-pointer shadow-md">
                        @if ($g->jenis == 'foto')
                            <img src="{{ asset('storage/' . $g->file_path) }}" alt="Foto Galeri" class="w-full h-full object-cover transition transform group-hover:scale-108 duration-500">
                        @else
                            <video class="w-full h-full object-cover pointer-events-none">
                                <source src="{{ asset('storage/' . $g->file_path) }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 flex items-center justify-center bg-slate-950/40 group-hover:bg-slate-950/20 transition">
                                <i class="fa-solid fa-play text-white text-lg drop-shadow-md"></i>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-teal-500/10 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <i class="fa-solid fa-magnifying-glass-plus text-white text-sm"></i>
                        </div>

                        <div class="absolute bottom-1.5 left-1.5 bg-slate-950/80 backdrop-blur-md px-2 py-0.5 rounded-lg text-[9px] text-teal-300 border border-slate-800/80 font-medium">
                            👤 {{ $g->user->name ?? 'User' }}
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-6 text-center bg-slate-950/40 rounded-2xl border border-slate-800/60 border-dashed">
                        <p class="text-xs text-slate-400 italic">Belum ada foto atau video di galeri ini. Jadilah yang pertama mengunggah!</p>
                    </div>
                @endforelse
            </div>

            <div class="bg-slate-950/70 p-4 rounded-2xl border border-slate-800/80 space-y-2.5 shadow-sm">
                <h4 class="font-bold text-white text-xs flex items-center space-x-1.5">
                    <i class="fa-solid fa-cloud-arrow-up text-teal-400"></i>
                    <span>Tambah Foto</span>
                </h4>
                <form action="{{ route('user.galeri.store', $destinasi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div>
                        <input type="file" name="media" accept="image/jpeg,image/png,image/jpg,video/mp4,video/mov,video/avi" required class="block w-full text-[11px] text-slate-400 file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-teal-500 file:text-slate-950 hover:file:bg-teal-400 cursor-pointer bg-slate-900 border border-slate-800 rounded-xl transition">
                        <p class="text-[10px] text-slate-500 mt-1.5">Maksimal ukuran: <b class="text-slate-400">Foto 5MB</b> | <b class="text-slate-400"></b></p>
                    </div>
                    <button type="submit" class="btn-micro w-full py-2.5 bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold rounded-xl text-xs transition shadow-md shadow-teal-500/10">
                        Unggah Ke Galeri
                    </button>
                </form>
            </div>
        </div>

        // Bagian statistik dan daftar komentar pengguna
        @php
            $reviewItems = $destinasi->reviews ?? collect();
            $totalReviews = $reviewItems->count();
            $avgRating = $totalReviews > 0 ? round($reviewItems->avg('rating'), 1) : 0;
            $ratingPercentage = round(($avgRating / 5) * 100);
            $latestReview = $reviewItems->sortByDesc('created_at')->first();
            $highestReview = $reviewItems->sortByDesc('rating')->sortByDesc('created_at')->first();
        @endphp

        <div class="scroll-reveal space-y-3.5 pt-2">
            <div class="flex flex-wrap justify-between items-center gap-2 border-b border-slate-800 pb-2.5">
                <h3 class="font-extrabold text-white text-xs">User Reviews</h3>
                <div class="flex items-center space-x-2">
                    <div class="flex items-center bg-slate-950 border border-slate-800 rounded-xl p-0.5 text-[10px]">
                        <button type="button" id="btnSortTerbaru" onclick="sortReviews('terbaru')" class="px-2.5 py-1 rounded-lg font-bold bg-teal-500 text-slate-950 transition">
                            Rating Terbaru
                        </button>
                        <button type="button" id="btnSortTertinggi" onclick="sortReviews('tertinggi')" class="px-2.5 py-1 rounded-lg font-bold text-slate-400 hover:text-white transition">
                            Rating Tertinggi
                        </button>
                    </div>
                    <div class="text-amber-400 font-bold text-xs flex items-center space-x-1.5 bg-amber-400/10 px-2.5 py-1 rounded-lg border border-amber-400/20">
                        <i class="fa-solid fa-star text-amber-400 text-[10px]"></i>
                        <span>{{ number_format($avgRating, 1) }} / 5.0 ({{ $ratingPercentage }}%)</span>
                    </div>
                </div>
            </div>

            @if($totalReviews > 0)
                // tampilan komentar tertinggi dan terbaru
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="bg-slate-950/70 p-3.5 rounded-2xl border border-slate-800/80 space-y-1.5">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-400">Rating Terbaru</span>
                            <span class="text-amber-400 font-bold text-[11px]">
                                <i class="fa-solid fa-star text-[10px]"></i> {{ $latestReview->rating }}/5
                            </span>
                        </div>
                        <p class="text-[11px] font-bold text-white">{{ $latestReview->user->name ?? 'Pengguna' }}</p>
                        // komentar terbaru
                        <p class="text-[11px] text-slate-300 line-clamp-2">{{ $latestReview->komentar }}</p>
                    </div>

                    <div class="bg-slate-950/70 p-3.5 rounded-2xl border border-slate-800/80 space-y-1.5">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-amber-400">Rating Tertinggi</span>
                            <span class="text-amber-400 font-bold text-[11px]">
                                <i class="fa-solid fa-star text-[10px]"></i> {{ $highestReview->rating }}/5
                            </span>
                        </div>
                        <p class="text-[11px] font-bold text-white">{{ $highestReview->user->name ?? 'Pengguna' }}</p>
                        // komentar rating tertinggi
                        <p class="text-[11px] text-slate-300 line-clamp-2">{{ $highestReview->komentar }}</p>
                    </div>
                </div>
            @endif
            
            // Daftar semua komentar pengguna
            <div id="reviewList" class="space-y-3 max-h-52 overflow-y-auto no-scrollbar">
                @forelse ($reviewItems->sortByDesc('created_at') as $rev)
                    <div class="review-item bg-slate-950/70 p-4 rounded-2xl border border-slate-800/80 flex items-start space-x-3 shadow-sm"
                         data-rating="{{ $rev->rating }}"
                         data-created="{{ $rev->created_at ? $rev->created_at->timestamp : $loop->iteration }}">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-teal-400 to-emerald-600 text-slate-950 font-black flex items-center justify-center text-xs flex-shrink-0 shadow-md">
                            {{ substr($rev->user->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="space-y-1 flex-1">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-white text-xs">{{ $rev->user->name ?? 'Pengguna' }}</span>
                                <div class="text-amber-400 text-[10px]">
                                    @for ($i = 0; $i < $rev->rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                    <span class="text-slate-400 ml-1">({{ $rev->rating }}/5)</span>
                                </div>
                            </div>
                            // Teks komentar ulasan pengguna
                            <p class="text-xs text-slate-300 leading-relaxed">{{ $rev->komentar }}</p>
                            @if($rev->foto)
                                <img src="{{ asset('storage/' . $rev->foto) }}" class="w-20 h-20 object-cover rounded-xl border border-slate-800 mt-2 shadow-md">
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-500 italic text-center py-3">Belum ada ulasan untuk destinasi ini.</p>
                @endforelse
            </div>
        </div>

        // bagian kirim komentar ulasan dengan validasi minimal 10 karakter
        <div class="scroll-reveal bg-slate-950/70 p-4.5 rounded-2xl border border-slate-800/80 space-y-3 shadow-sm">
            <h4 class="font-bold text-white text-xs flex items-center gap-1.5">
                <i class="fa-solid fa-pen-nib text-teal-400"></i>
                <span>Beri Ulasan Kamu</span>
            </h4>
            // bagian untuk mengirim komentar ke database
            <form id="reviewForm" action="{{ route('user.review.store', $destinasi->id) }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-[11px] text-slate-400 mb-1 font-medium">Rating Bintang:</label>
                    <select name="rating" class="w-full bg-slate-900 border border-slate-800 text-white rounded-xl px-3.5 py-2.5 text-xs focus:outline-none focus:border-teal-500 transition">
                        <option value="5">⭐⭐⭐⭐⭐ 5 Star</option>
                        <option value="4">⭐⭐⭐⭐ 4 Star</option>
                        <option value="3">⭐⭐⭐ 3 Star</option>
                        <option value="2">⭐⭐ 2 Star</option>
                        <option value="1">⭐ 1 Star</option>
                    </select>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-[11px] text-slate-400 font-medium">Komentar / Pengalaman:</label>
                        // Penghitung jumlah karakter komentar (minimal 10 karakter)
                        <span id="komentarCounter" class="text-[10px] text-slate-500">0 / min. 10 karakter</span>
                    </div>
                    // Input komentar ulasan validasi wajib 10 karakter
                    <textarea
                        id="komentarInput"
                        name="komentar"
                        rows="2"
                        minlength="10"
                        required
                        placeholder="Tuliskan ulasan kamu (minimal 10 karakter)..."
                        class="w-full bg-slate-900 border border-slate-800 text-white rounded-xl p-3.5 text-xs focus:outline-none focus:border-teal-500 transition placeholder-slate-500"
                    >{{ old('komentar') }}</textarea>
                    // Pesan peringatan ketika komentar kurang dari 10 karakter
                    <p id="komentarError" class="hidden text-[11px] text-rose-400 mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation text-[10px]"></i>
                        <span>Komentar minimal harus 10 karakter (tanpa spasi berlebih di awal/akhir).</span>
                    </p>
                </div>
                <button type="submit" class="btn-micro w-full py-2.5 bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold rounded-xl text-xs transition shadow-md shadow-teal-500/10">
                    Kirim Ulasan
                </button>
            </form>
        </div>

        @if($destinasi->link_maps)
            <div class="scroll-reveal pt-1">
                <a href="{{ $destinasi->link_maps }}" target="_blank" class="btn-micro block w-full text-center py-3 bg-gradient-to-r from-teal-500 to-emerald-400 hover:from-teal-400 hover:to-emerald-300 text-slate-950 font-black rounded-2xl text-xs transition shadow-xl shadow-teal-500/20">
                    Buka Google Maps / Lokasi 🗺️
                </a>
            </div>
        @endif

    </div>

    <div id="reportModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-50 hidden items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 w-full max-w-md rounded-3xl p-6 space-y-4 shadow-2xl relative glow-teal">
            <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                <h3 class="font-extrabold text-white text-sm flex items-center space-x-2">
                    <i class="fa-solid fa-flag text-rose-500"></i>
                    <span>Laporkan Destinasi Ini</span>
                </h3>
                <button onclick="closeReportModal()" class="btn-micro w-8 h-8 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition border border-slate-700">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>

            <form action="{{ route('user.destinasi.report', $destinasi->id) }}" method="POST" class="space-y-3.5 text-xs">
                @csrf
                <div>
                    <label class="block text-[11px] text-slate-400 mb-1 font-medium">Alasan Pelaporan:</label>
                    <select name="alasan" required class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-3.5 py-2.5 text-xs focus:outline-none focus:border-rose-500 transition">
                        <option value="" disabled selected>Pilih alasan laporan...</option>
                        <option value="Informasi / Alamat Palsu">Informasi / Alamat Palsu</option>
                        <option value="Destinasi Sudah Tutup / Permanen">Destinasi Sudah Tutup / Permanen</option>
                        <option value="Konten / Foto Tidak Pantas">Konten / Foto Tidak Pantas</option>
                        <option value="Duplikat Destinasi">Duplikat Destinasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] text-slate-400 mb-1 font-medium">Keterangan Tambahan:</label>
                    <textarea name="keterangan" rows="3" required placeholder="Jelaskan detail masalah pada destinasi ini..." class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl p-3.5 text-xs focus:outline-none focus:border-rose-500 transition placeholder-slate-500"></textarea>
                </div>
                <div class="flex space-x-2.5 pt-2">
                    <button type="button" onclick="closeReportModal()" class="btn-micro w-1/2 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold rounded-xl text-xs transition border border-slate-700">
                        Batal
                    </button>
                    <button type="submit" class="btn-micro w-1/2 py-2.5 bg-rose-500 hover:bg-rose-400 text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-rose-500/20">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="mediaModal" class="fixed inset-0 bg-slate-950/90 backdrop-blur-md z-50 hidden items-center justify-center p-4">
        <div class="relative max-w-4xl w-full flex flex-col items-center justify-center space-y-3">
            
            <button onclick="closeMediaModal()" class="btn-micro absolute -top-12 right-0 w-9 h-9 rounded-xl bg-slate-900 hover:bg-slate-800 text-white flex items-center justify-center transition border border-slate-700 shadow-xl z-20">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <button id="btnPrev" onclick="prevMedia()" class="btn-micro absolute left-2 md:-left-14 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-slate-900/90 hover:bg-slate-800 text-white flex items-center justify-center transition border border-slate-700 shadow-xl z-20">
                <i class="fa-solid fa-chevron-left text-sm"></i>
            </button>

            <button id="btnNext" onclick="nextMedia()" class="btn-micro absolute right-2 md:-right-14 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-slate-900/90 hover:bg-slate-800 text-white flex items-center justify-center transition border border-slate-700 shadow-xl z-20">
                <i class="fa-solid fa-chevron-right text-sm"></i>
            </button>

            <div class="w-full flex items-center justify-center max-h-[80vh] overflow-hidden rounded-2xl border border-slate-800 bg-slate-900 shadow-2xl relative">
                <img id="modalImage" src="" class="hidden max-h-[80vh] w-auto object-contain rounded-2xl">
                <video id="modalVideo" controls class="hidden max-h-[80vh] w-auto rounded-2xl">
                    <source id="modalVideoSource" src="" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video.
                </video>
            </div>

            <div class="flex items-center space-x-2 text-xs text-slate-300 bg-slate-900/90 backdrop-blur-md px-4 py-2 rounded-xl border border-slate-800 font-semibold shadow-lg">
                <span>Diunggah oleh: <b id="uploaderName" class="text-teal-400"></b></span>
                <span class="text-slate-600">|</span>
                <span id="mediaCounter" class="text-slate-400"></span>
            </div>
        </div>
    </div>

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

            document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

            // Mengambil elemen form dan input komentar ulasan
            const reviewForm = document.getElementById('reviewForm');
            const komentarInput = document.getElementById('komentarInput');
            const komentarCounter = document.getElementById('komentarCounter');
            const komentarError = document.getElementById('komentarError');

            if (reviewForm && komentarInput) {
                const updateKomentarUI = () => {
                    // Menghitung panjang komentar setelah semua spasi dari awal sampai akhir di hapus
                    const trimmedLength = komentarInput.value.trim().length;
                    komentarCounter.textContent = `${trimmedLength} / min. 10 karakter`;

                    if (trimmedLength >= 10) {
                        // komentar sudah bisa di tambahkan karna lebih dari 10 karakter
                        komentarCounter.className = 'text-[10px] text-teal-400 font-semibold';
                        komentarInput.classList.remove('border-rose-500', 'focus:border-rose-500');
                        komentarInput.classList.add('border-slate-800', 'focus:border-teal-500');
                        komentarError.classList.add('hidden');
                    } else {
                        // kalo komentar kurang dari 10 karakter 
                        komentarCounter.className = 'text-[10px] text-slate-400';
                    }
                };

                // Memantau ketikan komentar
                komentarInput.addEventListener('input', updateKomentarUI);
                updateKomentarUI();

                // validasi banyak nya komentar
                reviewForm.addEventListener('submit', function (e) {
                    const trimmedValue = komentarInput.value.trim();
                    if (trimmedValue.length < 10) {
                        // menolak pengiriman komentar apabila kurang dari 10 karakter
                        e.preventDefault();
                        komentarError.classList.remove('hidden');
                        komentarInput.classList.remove('border-slate-800', 'focus:border-teal-500');
                        komentarInput.classList.add('border-rose-500', 'focus:border-rose-500');
                        komentarInput.focus();
                    }
                });
            }
        });

        // Mengurutkan daftar ulasan dan komentar terbaru dan tertinggi
        function sortReviews(mode) {
            const list = document.getElementById('reviewList');
            const btnTerbaru = document.getElementById('btnSortTerbaru');
            const btnTertinggi = document.getElementById('btnSortTertinggi');
            if (!list) return;

            const items = Array.from(list.querySelectorAll('.review-item'));
            if (items.length === 0) return;

            items.sort((a, b) => {
                const ratingA = Number(a.dataset.rating || 0);
                const ratingB = Number(b.dataset.rating || 0);
                const createdA = Number(a.dataset.created || 0);
                const createdB = Number(b.dataset.created || 0);

                if (mode === 'tertinggi') {
                    if (ratingB !== ratingA) return ratingB - ratingA;
                    return createdB - createdA;
                }
                return createdB - createdA;
            });

            items.forEach(item => list.appendChild(item));

            if (mode === 'tertinggi') {
                btnTertinggi.className = 'px-2.5 py-1 rounded-lg font-bold bg-teal-500 text-slate-950 transition';
                btnTerbaru.className = 'px-2.5 py-1 rounded-lg font-bold text-slate-400 hover:text-white transition';
            } else {
                btnTerbaru.className = 'px-2.5 py-1 rounded-lg font-bold bg-teal-500 text-slate-950 transition';
                btnTertinggi.className = 'px-2.5 py-1 rounded-lg font-bold text-slate-400 hover:text-white transition';
            }
        }

        function handleBackWithAnimation(e, targetUrl) {
            e.preventDefault();
            const mainCard = document.getElementById('mainCard');
            if (mainCard) {
                mainCard.classList.add('anim-page-exit');
                setTimeout(() => {
                    window.location.href = targetUrl;
                }, 250);
            } else {
                window.location.href = targetUrl;
            }
        }

        const galeriRaw = @json($galeriItems);
        
        const galeriItems = galeriRaw.map(item => ({
            url: "{{ asset('storage') }}/" + item.file_path,
            type: item.jenis,
            user: item.user ? item.user.name : 'User'
        }));

        let currentIndex = 0;

        function openReportModal() {
            const modal = document.getElementById('reportModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function openMediaModal(index) {
            if (galeriItems.length === 0) return;
            currentIndex = index;
            updateMediaDisplay();

            const modal = document.getElementById('mediaModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeMediaModal() {
            const modal = document.getElementById('mediaModal');
            const modalVid = document.getElementById('modalVideo');
            if (modalVid) modalVid.pause();
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function updateMediaDisplay() {
            const currentItem = galeriItems[currentIndex];
            const modalImg = document.getElementById('modalImage');
            const modalVid = document.getElementById('modalVideo');
            const modalVidSrc = document.getElementById('modalVideoSource');
            const uploaderName = document.getElementById('uploaderName');
            const counter = document.getElementById('mediaCounter');

            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');

            uploaderName.innerText = currentItem.user;
            counter.innerText = `${currentIndex + 1} / ${galeriItems.length}`;

            if (currentItem.type === 'foto') {
                modalVid.classList.add('hidden');
                modalVid.pause();
                modalImg.src = currentItem.url;
                modalImg.classList.remove('hidden');
            } else {
                modalImg.classList.add('hidden');
                modalVidSrc.src = currentItem.url;
                modalVid.load();
                modalVid.classList.remove('hidden');
            }

            if (currentIndex === 0) {
                btnPrev.classList.add('hidden');
            } else {
                btnPrev.classList.remove('hidden');
            }

            if (currentIndex === galeriItems.length - 1) {
                btnNext.classList.add('hidden');
            } else {
                btnNext.classList.remove('hidden');
            }

            if (galeriItems.length <= 1) {
                btnPrev.classList.add('hidden');
                btnNext.classList.add('hidden');
            }
        }

        function prevMedia() {
            if (currentIndex > 0) {
                currentIndex--;
                updateMediaDisplay();
            }
        }

        function nextMedia() {
            if (currentIndex < galeriItems.length - 1) {
                currentIndex++;
                updateMediaDisplay();
            }
        }

        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('mediaModal');
            if (modal && !modal.classList.contains('hidden')) {
                if (e.key === 'ArrowLeft') {
                    prevMedia();
                } else if (e.key === 'ArrowRight') {
                    nextMedia();
                } else if (e.key === 'Escape') {
                    closeMediaModal();
                }
            }
        });
    </script>
</body>
</html>