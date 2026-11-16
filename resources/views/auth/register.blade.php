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
            background: #0B192C; 
        }

        /* Ambient Glow & Floating Animations (Sama persis dengan halaman login) */
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(2deg); }
        }

        @keyframes cardGlow {
            0%, 100% { box-shadow: 0 0 35px rgba(16, 185, 129, 0.25), 0 20px 40px rgba(0, 0, 0, 0.4); }
            50% { box-shadow: 0 0 55px rgba(16, 185, 129, 0.45), 0 25px 50px rgba(0, 0, 0, 0.5); }
        }

        @keyframes pulseSoft {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.05); }
        }

        .animate-float {
            animation: floatSlow 6s ease-in-out infinite;
        }

        .animate-glow-card {
            animation: cardGlow 4s ease-in-out infinite;
        }

        .animate-pulse-bg {
            animation: pulseSoft 8s ease-in-out infinite;
        }

        /* Inner Wave Overlay for Card Top */
        .card-wave-bg {
            background: linear-gradient(135deg, rgba(209, 250, 229, 0.6) 0%, rgba(255, 255, 255, 0.95) 40%, rgba(240, 253, 244, 0.4) 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-x-hidden bg-slate-950">

    <!-- Background Elements (Planet, Clouds, Sparkles - Konsisten dengan Login) -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <!-- Earth/Planet Globe Bottom Glow -->
        <div class="absolute -bottom-48 left-1/2 -translate-x-1/2 w-[1200px] h-[600px] bg-gradient-to-t from-emerald-600/30 via-teal-900/20 to-transparent rounded-t-[50%] blur-2xl animate-pulse-bg"></div>
        
        <!-- Background Orbs -->
        <div class="absolute top-1/4 left-10 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-teal-500/15 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>

        <!-- Decorative Crown SVG (Left background) -->
        <svg class="absolute top-1/3 left-8 w-48 h-48 text-white/5 animate-float" fill="currentColor" viewBox="0 0 24 24" style="animation-delay: -1.5s;">
            <path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5zm14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"/>
        </svg>

        <!-- Decorative Pin/Location Beacon (Right background) -->
        <div class="absolute top-1/3 right-16 flex flex-col items-center animate-float" style="animation-delay: -4s;">
            <div class="w-10 h-10 bg-emerald-400 rounded-full flex items-center justify-center shadow-lg shadow-emerald-400/50">
                <i data-lucide="map-pin" class="w-6 h-6 text-slate-900 fill-slate-900"></i>
            </div>
            <div class="w-24 h-0.5 border-b-2 border-dashed border-emerald-400/30 mt-4 -rotate-12"></div>
        </div>

        <!-- Airplane Silhouette (Top Right background) -->
        <i data-lucide="plane" class="absolute top-16 right-1/4 w-16 h-16 text-white/10 -rotate-12 animate-float" style="animation-delay: -2s;"></i>
    </div>

    <!-- Main Register Card -->
    <div class="w-full max-w-[460px] bg-white/95 backdrop-blur-xl rounded-[36px] p-8 sm:p-10 shadow-2xl border border-white/80 relative z-10 my-8 animate-glow-card transition-all duration-300">
        
        <!-- Top Light Emerald Wave Gradient Decoration -->
        <div class="absolute top-0 left-0 right-0 h-40 card-wave-bg rounded-t-[36px] -z-10"></div>

        <!-- Header / Logo -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-2xl mb-3 shadow-md shadow-emerald-500/10 border border-emerald-200/50 animate-float">
                <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center border-2 border-slate-900 shadow-sm">
                    <i data-lucide="user-plus" class="w-5 h-5 text-slate-900"></i>
                </div>
            </div>
            
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Bergabung dengan Lokalify</h1>
            <p class="text-xs text-slate-500 mt-1.5 font-medium flex items-center justify-center gap-1">
                Temukan berbagai destinasi wisata menarik 🗺️
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-2xl mb-6 text-xs text-red-700 shadow-sm">
                <p class="font-bold mb-1">⚠️ Terjadi Kesalahan:</p>
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <!-- Form -->
        <form id="registerForm" action="/register" method="POST" class="space-y-4">
            @csrf
            
            <!-- Default role langsung diset sebagai user -->
            <input type="hidden" name="role" value="user">

            <!-- Nama Lengkap -->
            <div>
                <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                    <i data-lucide="user" class="w-3.5 h-3.5 text-slate-600"></i>
                    Nama Lengkap
                </label>
                <div class="relative flex items-center">
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso"
                        class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-200/80 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-sm placeholder-slate-400 transition-all duration-200">
                </div>
            </div>

            <!-- Alamat Email -->
            <div>
                <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                    <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-600"></i>
                    Alamat Email
                </label>
                <div class="relative flex items-center">
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                        class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-200/80 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-sm placeholder-slate-400 transition-all duration-200">
                </div>
            </div>

            <!-- Password & Konfirmasi Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                        <i data-lucide="lock" class="w-3.5 h-3.5 text-slate-600"></i>
                        Kata Sandi
                    </label>
                    <div class="relative flex items-center">
                        <input type="password" id="passwordInput" name="password" required placeholder="Min. 6 karakter"
                            class="w-full pl-4 pr-10 py-3.5 bg-slate-50/80 border border-slate-200/80 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-sm placeholder-slate-400 transition-all duration-200">
                        <button type="button" onclick="togglePassword('passwordInput', 'eyeIcon1')" class="absolute right-3 text-slate-400 hover:text-slate-600 p-1">
                            <i data-lucide="eye-off" id="eyeIcon1" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                        <i data-lucide="lock" class="w-3.5 h-3.5 text-slate-600"></i>
                        Konfirmasi
                    </label>
                    <div class="relative flex items-center">
                        <input type="password" id="passwordConfirmInput" name="password_confirmation" required placeholder="Ulangi sandi"
                            class="w-full pl-4 pr-10 py-3.5 bg-slate-50/80 border border-slate-200/80 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-sm placeholder-slate-400 transition-all duration-200">
                        <button type="button" onclick="togglePassword('passwordConfirmInput', 'eyeIcon2')" class="absolute right-3 text-slate-400 hover:text-slate-600 p-1">
                            <i data-lucide="eye-off" id="eyeIcon2" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitBtnReg" 
                class="w-full mt-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 active:scale-[0.99] transition-all duration-200 flex items-center justify-center gap-2 text-sm group">
                <i data-lucide="sparkles" class="w-4 h-4 transition-transform group-hover:rotate-12"></i>
                <span id="btnTextReg">Daftar Akun Sekarang ✨</span>
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-6 pt-5 border-t border-slate-100/80 text-center relative">
            <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-white px-2 text-slate-300">
                <i data-lucide="crown" class="w-3.5 h-3.5"></i>
            </div>
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