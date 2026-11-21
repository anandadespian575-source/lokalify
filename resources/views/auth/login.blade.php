<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Lokalify 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome / Lucide Icons for clean iconography -->
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

    <!-- Main Login Card (Responsif di HP) -->
    <div id="loginCard" class="w-full max-w-[420px] bg-white/95 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-2xl border border-white/80 relative z-10 animate-glow-card transition-all duration-300">
        
        <!-- Top Light Emerald Wave Gradient Decoration -->
        <div class="absolute top-0 left-0 right-0 h-32 card-wave-bg rounded-t-3xl -z-10"></div>

        <!-- Header / Logo -->
        <div class="text-center mb-6 sm:mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-2xl mb-3 shadow-md border border-emerald-200/50">
                <!-- Key Icon -->
                <div class="w-8 h-8 bg-amber-400 rounded-xl flex items-center justify-center border-2 border-slate-900 shadow-sm">
                    <i data-lucide="key-round" class="w-4 h-4 text-slate-900"></i>
                </div>
            </div>
            
            <div class="flex items-center justify-center gap-1.5">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Lokalify</h1>
                <span class="text-amber-400 text-lg font-bold">✨</span>
            </div>
            <p class="text-xs sm:text-sm text-slate-500 mt-1 font-medium flex items-center justify-center gap-1">
                Jelajahi destinasi lokal terbaik 🗺️
            </p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-xl mb-5 text-xs sm:text-sm text-red-700 shadow-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form id="loginForm" action="/login" method="POST" class="space-y-4">
            @csrf
            
            <!-- Email Field -->
            <div>
                <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                    <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-600"></i>
                    Email
                </label>
                <div class="relative flex items-center">
                    <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3.5 pointer-events-none"></i>
                    <input type="email" name="email" required placeholder="nama@email.com"
                        class="w-full pl-10 pr-3.5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-xs sm:text-sm placeholder-slate-400">
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <label class="flex items-center gap-2 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                    <i data-lucide="lock" class="w-3.5 h-3.5 text-slate-600"></i>
                    Password
                </label>
                <div class="relative flex items-center">
                    <input type="password" id="passwordInput" name="password" required placeholder="••••••••"
                        class="w-full pl-3.5 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-xs sm:text-sm placeholder-slate-400">
                    <button type="button" onclick="togglePassword()" class="absolute right-3 text-slate-400 hover:text-slate-600 p-1">
                        <i data-lucide="eye-off" id="eyeIcon" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1 text-xs">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer accent-emerald-600">
                    <span class="text-slate-700 font-semibold">Ingat saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitBtn" 
                class="w-full mt-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-3 px-5 rounded-xl shadow-lg shadow-emerald-500/20 active:scale-[0.98] transition text-xs sm:text-sm flex items-center justify-center gap-2">
                <i data-lucide="log-in" class="w-4 h-4"></i>
                <span id="btnText">Masuk Sekarang 🚀</span>
            </button>
        </form>

        <!-- Divider & Footer -->
        <div class="mt-6 pt-5 border-t border-slate-100 text-center relative">
            <p class="text-xs text-slate-500 font-medium">
                Belum punya akun? 
                <a href="/register" class="font-bold text-emerald-600 hover:text-emerald-700 hover:underline transition ml-1">
                    Daftar Akun Baru 📍
                </a>
            </p>
        </div>
    </div>

    <!-- Script for Lucide Icons & Password Toggle -->
    <script>
        lucide.createIcons();

        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            }
            lucide.createIcons();
        }
    </script>
</body>
</html>