<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kabasa - Parkir Jadi Lebih Mudah</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
  }
  @keyframes floatSlow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(5deg); }
  }
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
  .animate-float { animation: float 4s ease-in-out infinite; }
  .animate-float-slow { animation: floatSlow 6s ease-in-out infinite; }
  .animate-blob { animation: blob 8s infinite ease-in-out; }
  .animate-blob-delay { animation: blob 8s infinite ease-in-out; animation-delay: 2s; }
  .animate-blob-delay2 { animation: blob 8s infinite ease-in-out; animation-delay: 4s; }
  .gradient-bg {
    background: linear-gradient(-45deg, #000000, #2563eb, #0ea5e9, #7c3aed);
    background-size: 400% 400%;
    animation: gradientShift 12s ease infinite;
  }
  .card-hover { transition: all 0.3s ease; }
  .card-hover:hover { transform: translateY(-10px) scale(1.02); }
  .glow { box-shadow: 0 0 40px rgba(124, 58, 237, 0.35); }
  body { font-family: 'Segoe UI', system-ui, sans-serif; }
</style>
</head>
<body class="bg-slate-50 text-slate-800 overflow-x-hidden">

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 w-full z-50 backdrop-blur-md bg-white/70 border-b border-white/40">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <div class="flex items-center gap-2">
      <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-600 to-blue-500 flex items-center justify-center text-white font-bold shadow-lg">P</div>
      <span class="font-extrabold text-xl bg-gradient-to-r from-violet-600 to-blue-500 bg-clip-text text-transparent">Kabasa</span>
    </div>
    <div class="hidden md:flex gap-8 text-sm font-medium text-slate-600">
      <a href="#fitur" class="hover:text-violet-600 transition">Fitur</a>
      <a href="#cara" class="hover:text-violet-600 transition">Cara Kerja</a>
    </div>
    <div class="flex gap-3">
      <a href="{{ route('register') }}" class="px-4 py-2 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-violet-600 to-blue-500 shadow-lg hover:shadow-violet-300 hover:scale-105 transition">Daftar</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="relative gradient-bg min-h-screen flex items-center justify-center pt-24 pb-20 overflow-hidden">
  <!-- Blobs -->
  <div class="absolute top-10 left-10 w-72 h-72 bg-pink-400/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
  <div class="absolute top-40 right-10 w-72 h-72 bg-yellow-300/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob-delay"></div>
  <div class="absolute bottom-10 left-1/3 w-72 h-72 bg-cyan-300/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob-delay2"></div>

  <!-- Floating icons -->
  <div class="absolute top-1/4 left-[8%] text-5xl animate-float-slow hidden md:block">🚗</div>
  <div class="absolute top-1/3 right-[10%] text-5xl animate-float hidden md:block">🅿️</div>
  <div class="absolute bottom-1/4 left-[15%] text-4xl animate-float-slow hidden md:block">💳</div>
  <div class="absolute bottom-1/3 right-[15%] text-4xl animate-float hidden md:block">🛵</div>

  <div class="relative z-10 max-w-4xl mx-auto text-center px-6">
    <span class="inline-block px-4 py-1.5 mb-6 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white text-sm font-semibold tracking-wide">
      ✨ Solusi Parkir Pintar #1
    </span>
    <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight drop-shadow-lg">
      Parkir Jadi Lebih Mudah<br>
      dengan <span class="bg-gradient-to-r from-yellow-300 via-pink-300 to-cyan-300 bg-clip-text text-transparent">Kabasa</span>
    </h1>
    <p class="mt-6 text-lg text-white/90 max-w-2xl mx-auto">
      Booking slot parkir, kelola kendaraan, dan bayar dengan mudah — semuanya dalam satu aplikasi.
    </p>
    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
  
  
      <a href="{{ route('login') }}" class="px-8 py-4 rounded-2xl bg-white/10 backdrop-blur-md border-2 border-white/60 text-white font-bold hover:bg-white/20 transition">
        Sudah Punya Akun? 🚀
      </a>
    </div>

    <!-- Stats -->
    <div class="mt-16 grid grid-cols-3 gap-6 max-w-lg mx-auto">
      <div>
        <p class="text-3xl font-extrabold text-white">500+</p>
        <p class="text-white/70 text-sm">Slot Parkir</p>
      </div>
      <div>
        <p class="text-3xl font-extrabold text-white">10rb+</p>
        <p class="text-white/70 text-sm">Pengguna</p>
      </div>
      <div>
        <p class="text-3xl font-extrabold text-white">4.9★</p>
        <p class="text-white/70 text-sm">Rating</p>
      </div>
    </div>
  </div>

  <!-- Wave divider -->
  <div class="absolute bottom-0 left-0 w-full">
    <svg viewBox="0 0 1440 120" class="w-full h-24 fill-slate-50"><path d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,80C1120,85,1280,75,1360,69.3L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path></svg>
  </div>
</section>

<!-- FEATURES -->
<section id="fitur" class="max-w-7xl mx-auto px-6 py-24">
  <div class="text-center mb-16">
    <span class="text-violet-600 font-bold tracking-wide uppercase text-sm">Fitur Unggulan</span>
    <h2 class="text-3xl md:text-4xl font-extrabold mt-2 text-slate-800">Semua yang Kamu Butuhkan</h2>
  </div>
  <div class="grid md:grid-cols-3 gap-8">

    <div class="card-hover bg-white rounded-3xl p-8 shadow-lg border border-slate-100">
      <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-400 flex items-center justify-center text-3xl mb-6 shadow-lg shadow-pink-200">
        📍
      </div>
      <h3 class="text-xl font-bold mb-2">Pilih Slot</h3>
      <p class="text-slate-500">Lihat slot parkir yang tersedia secara real-time, langsung dari genggaman.</p>
    </div>

    <div class="card-hover bg-white rounded-3xl p-8 shadow-lg border border-slate-100">
      <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-3xl mb-6 shadow-lg shadow-blue-200">
        🚗
      </div>
      <h3 class="text-xl font-bold mb-2">Booking Cepat</h3>
      <p class="text-slate-500">Booking untuk motor atau mobil dan lain lainya hanya dalam hitungan detik, tanpa ribet.</p>
    </div>

    <div class="card-hover bg-white rounded-3xl p-8 shadow-lg border border-slate-100">
      <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-400 flex items-center justify-center text-3xl mb-6 shadow-lg shadow-emerald-200">
        💳
      </div>
      <h3 class="text-xl font-bold mb-2">Bayar Mudah</h3>
      <p class="text-slate-500">Bayar dengan tunai, transfer, atau QRIS — pilih yang paling nyaman untukmu.</p>
    </div>

  </div>
</section>

<!-- CARA KERJA -->
<section id="cara" class="bg-gradient-to-b from-violet-50 to-white py-24">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <span class="text-violet-600 font-bold tracking-wide uppercase text-sm">Cara Kerja</span>
      <h2 class="text-3xl md:text-4xl font-extrabold mt-2 text-slate-800">Cuma 3 Langkah Mudah</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-8 relative">
      <div class="text-center">
        <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-violet-600 to-blue-500 text-white text-2xl font-extrabold flex items-center justify-center shadow-xl mb-6">1</div>
        <h4 class="font-bold text-lg mb-2">Daftar Akun</h4>
        <p class="text-slate-500 text-sm">Buat akun Kabasa gratis dalam hitungan menit.</p>
      </div>
      <div class="text-center">
        <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-violet-600 to-blue-500 text-white text-2xl font-extrabold flex items-center justify-center shadow-xl mb-6">2</div>
        <h4 class="font-bold text-lg mb-2">Cari & Booking</h4>
        <p class="text-slate-500 text-sm">Temukan slot parkir terdekat lalu booking langsung.</p>
      </div>
      <div class="text-center">
        <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-violet-600 to-blue-500 text-white text-2xl font-extrabold flex items-center justify-center shadow-xl mb-6">3</div>
        <h4 class="font-bold text-lg mb-2">Parkir & Bayar</h4>
        <p class="text-slate-500 text-sm">Parkir dengan tenang, bayar dengan metode favoritmu.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="relative py-20 px-6">
  <div class="max-w-5xl mx-auto rounded-3xl gradient-bg p-12 md:p-16 text-center shadow-2xl relative overflow-hidden">
    <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 relative z-10">Siap Parkir Tanpa Ribet?</h2>
    <p class="text-white/90 mb-8 relative z-10">Gabung sekarang dan rasakan kemudahan parkir bersama Kabasa.</p>
    <a href="{{ route('register') }}" class="relative z-10 inline-block px-8 py-4 rounded-2xl bg-white text-violet-700 font-bold shadow-xl hover:scale-105 transition">
      Daftar Gratis Sekarang
    </a>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-slate-900 text-slate-400 py-10 mt-10">
  <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
    <div class="flex items-center gap-2">
      <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-600 to-blue-500 flex items-center justify-center text-white font-bold text-sm">P</div>
      <span class="font-bold text-white">Kabasa</span>
    </div>
    <p class="text-sm">&copy; {{ date('Y') }} Kabasa. Semua hak dilindungi.</p>
  </div>
</footer>

</body>
</html>