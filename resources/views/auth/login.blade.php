<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Lokalify 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        
        .cursor-blink {
            display: inline-block;
            width: 8px;
            height: 1.1em;
            background-color: #10b981;
            margin-left: 3px;
            vertical-align: middle;
            animation: blink 0.9s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        
        @keyframes smoothFloatLogo {
            0%, 100% { transform: translateY(0px) scale(1); filter: drop-shadow(0 20px 30px rgba(16, 185, 129, 0.2)); }
            50% { transform: translateY(-10px) scale(1.02); filter: drop-shadow(0 25px 35px rgba(16, 185, 129, 0.35)); }
        }

        .animate-smooth-logo {
            animation: smoothFloatLogo 5s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl"></div>

    
    <div id="loginCard" class="w-full max-w-md bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20 relative z-10">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-2xl mb-3 shadow-inner">
                
                <div class="animate-smooth-logo inline-block">
                    <span class="text-3xl">📍</span>
                </div>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Lokalify</h1>
            <p class="text-sm text-slate-500 mt-1 font-medium">Jelajahi destinasi lokal terbaik 🗺️</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl mb-6 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form id="loginForm" action="/login" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email</label>
                <input type="email" name="email" required placeholder="nama@email.com"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none text-sm">
            </div>

            <button type="submit" id="submitBtn" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-emerald-600/30 transition text-sm flex items-center justify-center gap-2">
                <span id="btnText">Masuk Sekarang 🚀</span>
            </button>
        </form>

        <div class="mt-8 text-center pt-6 border-t border-slate-100">
            <p class="text-sm text-slate-600">
                Belum punya akun? <a href="/register" class="font-bold text-emerald-600 hover:underline">Daftar Akun Baru 📍</a>
            </p>
        </div>
    </div>

</body>
</html>