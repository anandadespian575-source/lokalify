<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - Lokalify 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome / Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #030712; 
            overflow-x: hidden; /* Mencegah geser ke samping */
        }

        /* Animasi ringan untuk entry-level device */
        @keyframes cardGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.15); }
            50% { box-shadow: 0 0 35px rgba(16, 185, 129, 0.3); }
        }

        .animate-glow-card {
            animation: cardGlow 4s ease-in-out infinite;
        }

        /* Inner Wave Overlay for Card Top */
        .card-wave-bg {
            background: linear-gradient(135deg, rgba(209, 250, 229, 0.6) 0%, rgba(255, 255, 255, 0.95) 40%, rgba(240, 253, 244, 0.4) 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-3 sm:p-4 relative bg-[#030712]">

    <!-- Background Elements (Disederhanakan agar ringan di HP) -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -bottom-24 left-1/2 -translate-x-1/2 w-full max-w-[800px] h-[300px] bg-gradient-to-t from-emerald-600/20 to-transparent rounded-t-[50%] blur-xl"></div>
    </div>

    <!-- Main Register Card (Responsif di HP) -->
    <div class="w-full max-w-[440px] bg-white/95 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-2xl border border-white/80 relative z-10 my-4 animate-glow-card transition-all duration-300">
        
        <!-- Top Light Emerald Wave Gradient Decoration -->
        <div class="absolute top-0 left-0 right-0 h-32 card-wave-bg rounded-t-3xl -z-10"></div>

        <!-- Header / Logo -->
        <div class="text-center mb-5 sm:mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-2xl mb-2.5 shadow-md border border-emerald-200/50">
                <div class="w-8 h-8 bg-amber-400 rounded-xl flex items-center justify-center border-2 border-slate-900 shadow-sm">
                    <i data-lucide="user-plus" class="w-4 h-4 text-slate-900"></i>
                </div>
            </div>
            
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Bergabung dengan Lokalify</h1>
            <p class="text-xs text-slate-500 mt-1 font-medium flex items-center justify-center gap-1">
                Temukan berbagai destinasi wisata menarik 🗺️
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-xl mb-4 text-xs text-red-700 shadow-sm">
                <p class="font-bold mb-0.5">⚠️ Terjadi Kesalahan:</p>
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <!-- Form -->
        <form id="registerForm" action="/register" method="POST" class="space-y-3.5">
            @csrf
            
            <!-- Default role langsung diset sebagai user -->
            <input type="hidden" name="role" value="user">

            <!-- Nama Lengkap -->
            <div>
                <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1">
                    <i data-lucide="user" class="w-3.5 h-3.5 text-slate-600"></i>
                    Nama Lengkap
                </label>
                <div class="relative flex items-center">
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso"
                        class="w-full px-3.5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-xs sm:text-sm placeholder-slate-400">
                </div>
            </div>

            <!-- Alamat Email -->
            <div>
                <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1">
                    <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-600"></i>
                    Alamat Email
                </label>
                <div class="relative flex items-center">
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                        class="w-full px-3.5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-xs sm:text-sm placeholder-slate-400">
                </div>
            </div>

            <!-- Password & Konfirmasi Password (Bertumpuk di HP, Berdampingan di Desktop) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1">
                        <i data-lucide="lock" class="w-3.5 h-3.5 text-slate-600"></i>
                        Kata Sandi
                    </label>
                    <div class="relative flex items-center">
                        <input type="password" id="passwordInput" name="password" required placeholder="Min. 6 karakter"
                            class="w-full pl-3.5 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-xs sm:text-sm placeholder-slate-400">
                        <button type="button" onclick="togglePassword('passwordInput', 'eyeIcon1')" class="absolute right-3 text-slate-400 hover:text-slate-600 p-1">
                            <i data-lucide="eye-off" id="eyeIcon1" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1">
                        <i data-lucide="lock" class="w-3.5 h-3.5 text-slate-600"></i>
                        Konfirmasi
                    </label>
                    <div class="relative flex items-center">
                        <input type="password" id="passwordConfirmInput" name="password_confirmation" required placeholder="Ulangi sandi"
                            class="w-full pl-3.5 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-xs sm:text-sm placeholder-slate-400">
                        <button type="button" onclick="togglePassword('passwordConfirmInput', 'eyeIcon2')" class="absolute right-3 text-slate-400 hover:text-slate-600 p-1">
                            <i data-lucide="eye-off" id="eyeIcon2" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitBtnReg" 
                class="w-full mt-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-emerald-500/20 active:scale-[0.98] transition flex items-center justify-center gap-2 text-xs sm:text-sm">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                <span id="btnTextReg">Daftar Akun Sekarang ✨</span>
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-5 pt-4 border-t border-slate-100 text-center relative">
            <p class="text-xs text-slate-500 font-medium">
                Sudah punya akun? 
                <a href="/login" class="font-bold text-emerald-600 hover:text-emerald-700 hover:underline transition ml-1">
                    Masuk di Sini ➔
                </a>
            </p>
        </div>
    </div>

    <!-- Script Lucide Icons & Interactivity -->
    <script>
        lucide.createIcons();

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye-off');
            }
            lucide.createIcons();
        }

        // Script Animasi Loading Register
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtnReg');
            const btnText = document.getElementById('btnTextReg');
            
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses Pendaftaran...
            `;
        });
    </script>
</body>
</html>