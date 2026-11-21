<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $destinasi->nama_destinasi }} - Detail Destinasi 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #030712;
            color: #f3f4f6;
            overflow-x: hidden; /* Mencegah geser ke samping */
        }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #090d16; }
        ::-webkit-scrollbar-thumb { background: #1f293d; border-radius: 9999px; }

        /* Animasi ringan untuk perangkat entry-level */
        @keyframes pageEntry {
            0% { opacity: 0; transform: translateY(12px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .anim-page-entry {
            animation: pageEntry 250ms ease-out forwards;
        }
        .anim-page-exit {
            opacity: 0;
            transition: opacity 150ms ease-out;
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(14px);
            transition: opacity 350ms ease-out, transform 350ms ease-out;
        }
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .btn-micro {
            transition: transform 0.15s ease;
        }
        .btn-micro:active {
            transform: scale(0.96) !important;
        }
    </style>
</head>
<body class="bg-[#030712] text-slate-100 min-h-screen flex items-start sm:items-center justify-center p-2.5 sm:p-4 text-xs antialiased selection:bg-teal-500 selection:text-slate-950">

    <div id="mainCard" class="anim-page-entry bg-slate-900 border border-slate-800 w-full max-w-2xl rounded-2xl sm:rounded-3xl overflow-hidden shadow-xl relative space-y-5 p-4 sm:p-6 md:p-8 my-2 sm:my-6">
        
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="bg-teal-500/10 border border-teal-500/30 text-teal-300 p-3 rounded-xl text-xs flex items-center space-x-2.5">
                <i class="fa-solid fa-circle-check text-teal-400 flex-shrink-0"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Notifikasi Error --}}
        @if($errors->any())
            <div class="bg-rose-500/10 border border-rose-500/30 text-rose-300 p-3 rounded-xl text-xs space-y-1.5">
                @foreach ($errors->all() as $error)
                    <p class="flex items-start space-x-2">
                        <i class="fa-solid fa-circle-exclamation text-rose-400 mt-0.5 flex-shrink-0"></i>
                        <span class="font-medium">{{ $error }}</span>
                    </p>
                @endforeach
            </div>
        @endif

        {{-- Bar Navigasi Atas (Rapi & Tidak Menumpuk di HP) --}}
        <div class="flex items-center justify-between gap-2">
            <span class="bg-slate-950 px-3 py-1.5 rounded-xl text-[11px] font-bold text-teal-300 border border-slate-800 truncate">
                {{ $destinasi->kategori->nama_kategori ?? 'Wisata' }}
            </span>

            <div class="flex items-center space-x-2 flex-shrink-0">
                <form action="{{ route('user.wishlist.toggle', $destinasi->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-micro h-8 px-3 rounded-xl bg-slate-950 hover:bg-slate-800 border border-slate-800 flex items-center gap-1.5 text-[11px] font-semibold text-slate-200" title="Simpan ke Wishlist">
                        @if(isset($isWishlist) && $isWishlist)
                            <i class="fa-solid fa-heart text-rose-500 text-xs"></i>
                            <span class="hidden sm:inline text-rose-400">Tersimpan</span>
                        @else
                            <i class="fa-regular fa-heart text-slate-300 text-xs"></i>
                            <span class="hidden sm:inline">Wishlist</span>
                        @endif
                    </button>
                </form>

                <button onclick="openReportModal()" class="btn-micro h-8 px-3 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 flex items-center space-x-1.5 border border-rose-500/20 text-[11px] font-bold" title="Laporkan Destinasi">
                    <i class="fa-solid fa-flag text-[10px]"></i>
                    <span>Lapor</span>
                </button>

                <a href="{{ route('user.dashboard') }}" onclick="handleBackWithAnimation(event, this.href)" class="btn-micro w-8 h-8 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 flex items-center justify-center border border-slate-700" title="Kembali ke Dashboard">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </a>
            </div>
        </div>

        {{-- Foto Utama Destinasi --}}
        <div class="relative w-full h-52 sm:h-72 rounded-2xl overflow-hidden bg-slate-950 border border-slate-800">
            @if($destinasi->foto)
                <img src="{{ asset('storage/' . $destinasi->foto) }}" alt="{{ $destinasi->nama_destinasi }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-5xl bg-slate-900 text-teal-400">
                    <i class="fa-solid fa-mountain-sun"></i>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
        </div>

        {{-- Judul & Info Lokasi --}}
        <div class="space-y-2">
            <h1 class="text-lg sm:text-2xl font-black text-white tracking-tight leading-snug">
                {{ $destinasi->nama_destinasi }}
            </h1>
            <p class="text-xs text-teal-400 font-semibold flex items-start space-x-1.5">
                <i class="fa-solid fa-location-dot mt-0.5 flex-shrink-0"></i>
                <span>{{ $destinasi->alamat ?? 'Lokasi tidak tersedia' }}</span>
            </p>
            @if($destinasi->jam_buka)
                <p class="text-[11px] text-slate-400 flex items-center space-x-1.5">
                    <i class="fa-regular fa-clock text-teal-400 flex-shrink-0"></i>
                    <span>Jam Operasional: {{ $destinasi->jam_buka }}</span>
                </p>
            @endif
        </div>

        {{-- Highlight / Profil Singkat --}}
        @if($destinasi->deskripsi_singkat)
            <div class="bg-teal-500/10 border border-teal-500/20 p-3.5 sm:p-4 rounded-2xl space-y-1.5">
                <h2 class="font-extrabold text-teal-300 text-[11px] uppercase tracking-wider">Harga:</h2>
                <p class="text-xs text-slate-200 leading-relaxed">{{ $destinasi->deskripsi_singkat }}</p>
            </div>
        @endif

        {{-- Detail Lengkap & Fasilitas --}}
        <div class="space-y-2 bg-slate-950/80 p-4 rounded-2xl border border-slate-800">
            <h2 class="font-extrabold text-slate-200 text-[11px] uppercase tracking-wider">Detail Lengkap & Fasilitas</h2>
            <p class="text-xs text-slate-300 leading-relaxed whitespace-pre-line break-words">
                {{ $destinasi->deskripsi_lengkap ?? $destinasi->deskripsi ?? 'Belum ada detail penjelasan.' }}
            </p>
        </div>

        {{-- Galeri Wisatawan --}}
        @php
            $galeriItems = $destinasi->galeri ?? collect();
        @endphp
        <div class="scroll-reveal space-y-3.5 pt-1">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1 border-b border-slate-800 pb-2.5">
                <h2 class="font-extrabold text-white text-xs sm:text-sm flex items-center space-x-2">
                    <i class="fa-solid fa-images text-teal-400"></i>
                    <span>Galeri Wisatawan</span>
                </h2>
                <span class="text-[10px] text-slate-400">Ketuk foto/video untuk memperbesar</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 max-h-64 overflow-y-auto no-scrollbar">
                @forelse ($galeriItems as $index => $g)
                    <div onclick="openMediaModal({{ $index }})" 
                         class="btn-micro relative group rounded-xl overflow-hidden bg-slate-950 border border-slate-800 h-28 cursor-pointer">
                        @if ($g->jenis == 'foto')
                            <img src="{{ asset('storage/' . $g->file_path) }}" alt="Foto Galeri" loading="lazy" class="w-full h-full object-cover">
                        @else
                            <video class="w-full h-full object-cover pointer-events-none" preload="metadata">
                                <source src="{{ asset('storage/' . $g->file_path) }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 flex items-center justify-center bg-slate-950/40">
                                <i class="fa-solid fa-play text-white text-base"></i>
                            </div>
                        @endif

                        <div class="absolute bottom-1.5 left-1.5 right-1.5 bg-slate-950/85 px-2 py-0.5 rounded-lg text-[9px] text-teal-300 border border-slate-800 font-medium truncate">
                            👤 {{ $g->user->name ?? 'User' }}
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-6 text-center bg-slate-950/50 rounded-2xl border border-slate-800 border-dashed px-3">
                        <p class="text-xs text-slate-400 italic">Belum ada foto atau video di galeri ini. Jadilah yang pertama mengunggah!</p>
                    </div>
                @endforelse
            </div>

            {{-- Form Unggah Galeri --}}
            <div class="bg-slate-950/80 p-3.5 sm:p-4 rounded-2xl border border-slate-800 space-y-2.5">
                <h3 class="font-bold text-white text-xs flex items-center space-x-1.5">
                    <i class="fa-solid fa-cloud-arrow-up text-teal-400"></i>
                    <span>Tambah Foto / Video</span>
                </h3>
                <form action="{{ route('user.galeri.store', $destinasi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div>
                        <input type="file" name="media" accept="image/jpeg,image/png,image/jpg,video/mp4,video/mov,video/avi" required class="block w-full text-[11px] text-slate-400 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-teal-500 file:text-slate-950 cursor-pointer bg-slate-900 border border-slate-800 rounded-xl">
                        <p class="text-[10px] text-slate-500 mt-1.5">Maksimal ukuran: <b class="text-slate-400">Foto 5MB</b></p>
                    </div>
                    <button type="submit" class="btn-micro w-full py-2.5 bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold rounded-xl text-xs">
                        Unggah Ke Galeri
                    </button>
                </form>
            </div>
        </div>

        {{-- Statistik & Ulasan Pengguna --}}
        @php
            $reviewItems = $destinasi->reviews ?? collect();
            $totalReviews = $reviewItems->count();
            $avgRating = $totalReviews > 0 ? round($reviewItems->avg('rating'), 1) : 0;
            $ratingPercentage = round(($avgRating / 5) * 100);
            $latestReview = $reviewItems->sortByDesc('created_at')->first();
            $highestReview = $reviewItems->sortByDesc('rating')->sortByDesc('created_at')->first();

            $maxUserRatings = 2;
            $currentUserId = auth()->id();
            $userReviewCount = $userReviewCount
                ?? ($currentUserId ? $reviewItems->where('user_id', $currentUserId)->count() : 0);
            $remainingRatings = max(0, $maxUserRatings - $userReviewCount);
        @endphp

        <div class="scroll-reveal space-y-3.5 pt-1">
            {{-- Header Ulasan & Tombol Filter (Vertikal di HP, Horizontal di Layar Lebih Lebar) --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2.5 border-b border-slate-800 pb-3">
                <div class="flex items-center justify-between sm:justify-start gap-2">
                    <h2 class="font-extrabold text-white text-xs sm:text-sm">Ulasan Pengguna</h2>
                    <div class="text-amber-400 font-bold text-[11px] flex items-center space-x-1 bg-amber-400/10 px-2.5 py-1 rounded-lg border border-amber-400/20">
                        <i class="fa-solid fa-star text-amber-400 text-[10px]"></i>
                        <span>{{ number_format($avgRating, 1) }} / 5.0 ({{ $ratingPercentage }}%)</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:flex items-center bg-slate-950 border border-slate-800 rounded-xl p-1 text-[11px] gap-1">
                    <button type="button" id="btnSortTerbaru" onclick="sortReviews('terbaru')" class="px-2.5 py-1.5 rounded-lg font-bold bg-teal-500 text-slate-950 text-center">
                        Rating Terbaru
                    </button>
                    <button type="button" id="btnSortTertinggi" onclick="sortReviews('tertinggi')" class="px-2.5 py-1.5 rounded-lg font-bold text-slate-400 hover:text-white text-center">
                        Rating Tertinggi
                    </button>
                </div>
            </div>

            <p class="text-[11px] text-slate-400 leading-relaxed">
                <b class="text-slate-300">Keterangan:</b> Gunakan tombol di atas untuk mengurutkan daftar ulasan di bawah.
            </p>

            {{-- Sorotan Ulasan (Bertumpuk Vertikal di HP) --}}
            @if($totalReviews > 0)
                <div class="bg-slate-950/60 border border-slate-800 rounded-2xl p-3.5 space-y-2.5">
                    <p class="text-[11px] text-slate-400">
                        <b class="text-slate-300">Ringkasan Sorotan:</b> Ulasan terbaru & ulasan dengan bintang tertinggi.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        <div class="bg-slate-900 p-3 rounded-xl border border-slate-800 space-y-1">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-400">Rating Terbaru</span>
                                <span class="text-amber-400 font-bold text-[11px]">
                                    <i class="fa-solid fa-star text-[10px]"></i> {{ $latestReview->rating }}/5
                                </span>
                            </div>
                            <p class="text-xs font-bold text-white truncate">{{ $latestReview->user->name ?? 'Pengguna' }}</p>
                            <p class="text-[11px] text-slate-300 line-clamp-2">{{ $latestReview->komentar }}</p>
                        </div>

                        <div class="bg-slate-900 p-3 rounded-xl border border-slate-800 space-y-1">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-amber-400">Rating Tertinggi</span>
                                <span class="text-amber-400 font-bold text-[11px]">
                                    <i class="fa-solid fa-star text-[10px]"></i> {{ $highestReview->rating }}/5
                                </span>
                            </div>
                            <p class="text-xs font-bold text-white truncate">{{ $highestReview->user->name ?? 'Pengguna' }}</p>
                            <p class="text-[11px] text-slate-300 line-clamp-2">{{ $highestReview->komentar }}</p>
                        </div>
                    </div>
                </div>
            @endif
            
            {{-- Daftar Semua Komentar --}}
            <div id="reviewList" class="space-y-2.5 max-h-60 overflow-y-auto no-scrollbar">
                @forelse ($reviewItems->sortByDesc('created_at') as $rev)
                    <div class="review-item bg-slate-950/80 p-3.5 rounded-2xl border border-slate-800 flex items-start space-x-3"
                         data-rating="{{ $rev->rating }}"
                         data-created="{{ $rev->created_at ? $rev->created_at->timestamp : $loop->iteration }}">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-teal-400 to-emerald-600 text-slate-950 font-black flex items-center justify-center text-xs flex-shrink-0">
                            {{ substr($rev->user->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="space-y-1 flex-1 min-w-0">
                            <div class="flex flex-wrap justify-between items-center gap-1">
                                <span class="font-bold text-white text-xs truncate">{{ $rev->user->name ?? 'Pengguna' }}</span>
                                <div class="text-amber-400 text-[10px] flex-shrink-0">
                                    @for ($i = 0; $i < $rev->rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                    <span class="text-slate-400 ml-1">({{ $rev->rating }}/5)</span>
                                </div>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed break-words">{{ $rev->komentar }}</p>
                            @if($rev->foto)
                                <img src="{{ asset('storage/' . $rev->foto) }}" loading="lazy" class="w-20 h-20 object-cover rounded-xl border border-slate-800 mt-2">
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-500 italic text-center py-4">Belum ada ulasan untuk destinasi ini.</p>
                @endforelse
            </div>
        </div>

        {{-- Form Kirim Ulasan --}}
        <div class="scroll-reveal bg-slate-950/80 p-4 rounded-2xl border border-slate-800 space-y-3">
            <div class="flex flex-wrap justify-between items-center gap-2">
                <h3 class="font-bold text-white text-xs flex items-center gap-1.5">
                    <i class="fa-solid fa-pen-nib text-teal-400"></i>
                    <span>Beri Ulasan Kamu</span>
                </h3>
                <span class="text-[10px] font-semibold px-2.5 py-1 rounded-lg bg-slate-900 border border-slate-800 {{ $remainingRatings > 0 ? 'text-teal-400' : 'text-amber-400' }}">
                    Kuota rating: {{ $userReviewCount }} / {{ $maxUserRatings }} kali
                </span>
            </div>

            @if ($userReviewCount >= $maxUserRatings)
                <div class="bg-amber-500/10 border border-amber-500/30 text-amber-300 p-3 rounded-xl text-xs flex items-start space-x-2.5">
                    <i class="fa-solid fa-circle-info text-amber-400 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="font-bold">Batas Rating Tercapai (2/2)</p>
                        <p class="text-[11px] text-amber-200/80 mt-0.5 leading-relaxed">
                            Kamu sudah memberikan rating sebanyak {{ $maxUserRatings }} kali untuk destinasi ini.
                        </p>
                    </div>
                </div>
            @else
                <form id="reviewForm"
                      action="{{ route('user.review.store', $destinasi->id) }}"
                      method="POST"
                      data-user-review-count="{{ $userReviewCount }}"
                      data-max-ratings="{{ $maxUserRatings }}"
                      class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-[11px] text-slate-400 mb-1 font-medium">Rating Bintang:</label>
                        <select name="rating" class="w-full bg-slate-900 border border-slate-800 text-white rounded-xl px-3 py-2.5 text-xs focus:outline-none focus:border-teal-500">
                            <option value="5">⭐⭐⭐⭐⭐ 5 Bintang</option>
                            <option value="4">⭐⭐⭐⭐ 4 Bintang</option>
                            <option value="3">⭐⭐⭐ 3 Bintang</option>
                            <option value="2">⭐⭐ 2 Bintang</option>
                            <option value="1">⭐ 1 Bintang</option>
                        </select>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1 gap-2">
                            <label class="block text-[11px] text-slate-400 font-medium">Komentar / Pengalaman:</label>
                            <span id="komentarCounter" class="text-[10px] text-slate-500 flex-shrink-0">0 / min. 10 karakter</span>
                        </div>
                        <textarea
                            id="komentarInput"
                            name="komentar"
                            rows="3"
                            minlength="10"
                            required
                            placeholder="Tuliskan ulasan kamu (minimal 10 karakter)..."
                            class="w-full bg-slate-900 border border-slate-800 text-white rounded-xl p-3 text-xs focus:outline-none focus:border-teal-500 placeholder-slate-500"
                        >{{ old('komentar') }}</textarea>
                        <p id="komentarError" class="hidden text-[11px] text-rose-400 mt-1 flex items-start gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px] mt-0.5 flex-shrink-0"></i>
                            <span>Komentar minimal harus 10 karakter (tanpa spasi berlebih di awal/akhir).</span>
                        </p>
                    </div>
                    <button type="submit" class="btn-micro w-full py-2.5 bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold rounded-xl text-xs">
                        Kirim Ulasan (Sisa {{ $remainingRatings }}x)
                    </button>
                </form>
            @endif
        </div>

        {{-- Tombol Google Maps --}}
        @if($destinasi->link_maps)
            <div class="scroll-reveal pt-1">
                <a href="{{ $destinasi->link_maps }}" target="_blank" class="btn-micro block w-full text-center py-3 bg-gradient-to-r from-teal-500 to-emerald-400 text-slate-950 font-black rounded-2xl text-xs shadow-lg">
                    Buka Google Maps / Lokasi 🗺️
                </a>
            </div>
        @endif

    </div>

    {{-- Modal Lapor Destinasi --}}
    <div id="reportModal" class="fixed inset-0 bg-slate-950/85 z-50 hidden items-center justify-center p-3 sm:p-4">
        <div class="bg-slate-900 border border-slate-800 w-full max-w-md rounded-2xl sm:rounded-3xl p-4 sm:p-6 space-y-4 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                <h3 class="font-extrabold text-white text-sm flex items-center space-x-2">
                    <i class="fa-solid fa-flag text-rose-500"></i>
                    <span>Laporkan Destinasi Ini</span>
                </h3>
                <button onclick="closeReportModal()" class="btn-micro w-8 h-8 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center border border-slate-700">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>

            <form action="{{ route('user.destinasi.report', $destinasi->id) }}" method="POST" class="space-y-3.5 text-xs">
                @csrf
                <div>
                    <label class="block text-[11px] text-slate-400 mb-1 font-medium">Alasan Pelaporan:</label>
                    <select name="alasan" required class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-3 py-2.5 text-xs focus:outline-none focus:border-rose-500">
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
                    <textarea name="keterangan" rows="3" required placeholder="Jelaskan detail masalah pada destinasi ini..." class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl p-3 text-xs focus:outline-none focus:border-rose-500 placeholder-slate-500"></textarea>
                </div>
                <div class="flex flex-col sm:flex-row gap-2 pt-2">
                    <button type="button" onclick="closeReportModal()" class="btn-micro w-full sm:w-1/2 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold rounded-xl text-xs border border-slate-700">
                        Batal
                    </button>
                    <button type="submit" class="btn-micro w-full sm:w-1/2 py-2.5 bg-rose-500 hover:bg-rose-400 text-white font-extrabold rounded-xl text-xs">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Lightbox Galeri (Responsif di HP) --}}
    <div id="mediaModal" class="fixed inset-0 bg-slate-950/95 z-50 hidden items-center justify-center p-3 sm:p-4">
        <div class="relative max-w-3xl w-full flex flex-col items-center justify-center space-y-3">
            
            <div class="w-full flex justify-between items-center">
                <div class="text-xs text-slate-300 bg-slate-900 px-3 py-1.5 rounded-xl border border-slate-800 font-semibold truncate max-w-[75%]">
                    Oleh: <b id="uploaderName" class="text-teal-400"></b> (<span id="mediaCounter" class="text-slate-400"></span>)
                </div>
                <button onclick="closeMediaModal()" class="btn-micro w-9 h-9 rounded-xl bg-slate-900 hover:bg-slate-800 text-white flex items-center justify-center border border-slate-700 flex-shrink-0">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <div class="w-full flex items-center justify-center max-h-[72vh] overflow-hidden rounded-2xl border border-slate-800 bg-slate-900 relative">
                <button id="btnPrev" onclick="prevMedia()" class="btn-micro absolute left-2 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-slate-950/85 text-white flex items-center justify-center border border-slate-700 z-20">
                    <i class="fa-solid fa-chevron-left text-xs sm:text-sm"></i>
                </button>

                <img id="modalImage" src="" class="hidden max-h-[72vh] w-auto object-contain">
                <video id="modalVideo" controls class="hidden max-h-[72vh] w-auto">
                    <source id="modalVideoSource" src="" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video.
                </video>

                <button id="btnNext" onclick="nextMedia()" class="btn-micro absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-slate-950/85 text-white flex items-center justify-center border border-slate-700 z-20">
                    <i class="fa-solid fa-chevron-right text-xs sm:text-sm"></i>
                </button>
            </div>
        </div>
    </div>

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

            document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

            const reviewForm = document.getElementById('reviewForm');
            const komentarInput = document.getElementById('komentarInput');
            const komentarCounter = document.getElementById('komentarCounter');
            const komentarError = document.getElementById('komentarError');

            if (reviewForm && komentarInput) {
                const updateKomentarUI = () => {
                    const trimmedLength = komentarInput.value.trim().length;
                    komentarCounter.textContent = `${trimmedLength} / min. 10 karakter`;

                    if (trimmedLength >= 10) {
                        komentarCounter.className = 'text-[10px] text-teal-400 font-semibold flex-shrink-0';
                        komentarInput.classList.remove('border-rose-500', 'focus:border-rose-500');
                        komentarInput.classList.add('border-slate-800', 'focus:border-teal-500');
                        komentarError.classList.add('hidden');
                    } else {
                        komentarCounter.className = 'text-[10px] text-slate-400 flex-shrink-0';
                    }
                };

                komentarInput.addEventListener('input', updateKomentarUI);
                updateKomentarUI();

                reviewForm.addEventListener('submit', function (e) {
                    const userCount = Number(reviewForm.dataset.userReviewCount || 0);
                    const maxRatings = Number(reviewForm.dataset.maxRatings || 2);

                    if (userCount >= maxRatings) {
                        e.preventDefault();
                        alert(`Kamu sudah memberikan rating sebanyak ${maxRatings} kali untuk destinasi ini.`);
                        return;
                    }

                    if (komentarInput.value.trim().length < 10) {
                        e.preventDefault();
                        komentarError.classList.remove('hidden');
                        komentarInput.classList.remove('border-slate-800', 'focus:border-teal-500');
                        komentarInput.classList.add('border-rose-500', 'focus:border-rose-500');
                        komentarInput.focus();
                    }
                });
            }
        });

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
                    return ratingB !== ratingA ? ratingB - ratingA : createdB - createdA;
                }
                return createdB - createdA;
            });

            items.forEach(item => list.appendChild(item));

            if (mode === 'tertinggi') {
                btnTertinggi.className = 'px-2.5 py-1.5 rounded-lg font-bold bg-teal-500 text-slate-950 text-center';
                btnTerbaru.className = 'px-2.5 py-1.5 rounded-lg font-bold text-slate-400 hover:text-white text-center';
            } else {
                btnTerbaru.className = 'px-2.5 py-1.5 rounded-lg font-bold bg-teal-500 text-slate-950 text-center';
                btnTertinggi.className = 'px-2.5 py-1.5 rounded-lg font-bold text-slate-400 hover:text-white text-center';
            }
        }

        function handleBackWithAnimation(e, targetUrl) {
            e.preventDefault();
            const mainCard = document.getElementById('mainCard');
            if (mainCard) {
                mainCard.classList.add('anim-page-exit');
                setTimeout(() => { window.location.href = targetUrl; }, 150);
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
            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');

            document.getElementById('uploaderName').innerText = currentItem.user;
            document.getElementById('mediaCounter').innerText = `${currentIndex + 1}/${galeriItems.length}`;

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

            btnPrev.classList.toggle('hidden', currentIndex === 0 || galeriItems.length <= 1);
            btnNext.classList.toggle('hidden', currentIndex === galeriItems.length - 1 || galeriItems.length <= 1);
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
                if (e.key === 'ArrowLeft') prevMedia();
                else if (e.key === 'ArrowRight') nextMedia();
                else if (e.key === 'Escape') closeMediaModal();
            }
        });
    </script>
</body>
</html>