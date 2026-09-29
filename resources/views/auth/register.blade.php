<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar - Kabasa</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  @keyframes blob {
    0%, 100% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -40px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
  }
  @keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
  }
  body {
    background: linear-gradient(-45deg, #6d28d9, #2563eb, #0ea5e9, #7c3aed);
    background-size: 400% 400%;
    animation: gradientShift 12s ease infinite;
    font-family: 'Segoe UI', system-ui, sans-serif;
  }
  .animate-blob { animation: blob 8s infinite ease-in-out; }
  .animate-blob-delay { animation: blob 8s infinite ease-in-out; animation-delay: 2s; }
  .animate-blob-delay2 { animation: blob 8s infinite ease-in-out; animation-delay: 4s; }
  .animate-float { animation: float 5s ease-in-out infinite; }
  .input-glow:focus { box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.15); }
</style>
</head>
<body class="min-h-screen relative overflow-x-hidden">

    <!-- Blobs -->
    <div class="fixed top-10 left-10 w-72 h-72 bg-pink-400/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="fixed top-40 right-10 w-72 h-72 bg-yellow-300/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob-delay"></div>
    <div class="fixed bottom-10 left-1/3 w-72 h-72 bg-cyan-300/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob-delay2"></div>

    <!-- Floating icons -->
    <div class="fixed top-1/4 left-[10%] text-4xl animate-float hidden md:block">🚗</div>
    <div class="fixed bottom-1/4 right-[10%] text-4xl animate-float hidden md:block" style="animation-delay: 1.5s;">🅿️</div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">

            <!-- Logo / Brand -->
            <div class="flex flex-col items-center mb-8">
                <a href="/" class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-3xl font-extrabold text-white shadow-lg mb-3">
                    P
                </a>
                <h1 class="text-2xl font-extrabold text-white drop-shadow text-center">Gabung Bersama <span class="bg-gradient-to-r from-yellow-300 via-pink-300 to-cyan-300 bg-clip-text text-transparent">Kabasa</span></h1>
                <p class="text-white/80 text-sm mt-1">Daftar dan mulai parkir tanpa ribet</p>
            </div>

            <!-- Card -->
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-8 md:p-10">

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="input-glow w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-violet-500 focus:outline-none transition"
                            placeholder="Nama lengkap kamu">
                        @error('name')
                            <p class="mt-1.5 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="input-glow w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-violet-500 focus:outline-none transition"
                            placeholder="nama@email.com">
                        @error('email')
                            <p class="mt-1.5 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="input-glow w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-violet-500 focus:outline-none transition"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-1.5 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="input-glow w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-violet-500 focus:outline-none transition"
                            placeholder="••••••••">
                        @error('password_confirmation')
                            <p class="mt-1.5 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-3.5 rounded-xl bg-gradient-to-r from-violet-600 to-blue-500 text-white font-bold shadow-lg hover:shadow-violet-300 hover:scale-[1.02] transition">
                        Daftar
                    </button>

                    <p class="text-center text-sm text-slate-500 pt-2">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-violet-600 hover:text-violet-800 transition">Masuk di sini</a>
                    </p>
                </form>
            </div>

            <p class="text-center text-white/70 text-xs mt-6">&copy; {{ date('Y') }} Kabasa. Semua hak dilindungi.</p>
        </div>
    </div>

</body>
</html>