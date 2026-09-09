<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome banner -->
            <div class="relative overflow-hidden rounded-3xl p-8 md:p-10 shadow-xl"
                 style="background: linear-gradient(-45deg, #6d28d9, #2563eb, #0ea5e9, #7c3aed); background-size: 400% 400%; animation: gradientShift 12s ease infinite;">
                <style>
                    @keyframes gradientShift {
                        0% { background-position: 0% 50%; }
                        50% { background-position: 100% 50%; }
                        100% { background-position: 0% 50%; }
                    }
                </style>
                <div class="absolute -top-10 -right-10 w-56 h-56 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-56 h-56 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <p class="text-white/80 text-sm font-semibold">Selamat datang kembali,</p>
                        <h3 class="text-2xl md:text-3xl font-extrabold text-white mt-1">{{ Auth::user()->name }} 👋</h3>
                        <p class="text-white/90 mt-2">
                            @if(Auth::user()->isAdmin())
                                You're logged in as Admin! Semua booking, slot, dan user bisa kamu kelola dari sini.
                            @elseif(Auth::user()->isPetugas())
                                You're logged in as Petugas! Kelola transaksi dan cetak struk parkir dari sini.
                            @elseif(Auth::user()->isOwner())
                                You're logged in as Owner! Pantau rekap transaksi dan pendapatan dari sini.
                            @else
                                You're logged in! Semua booking dan slot parkir bisa kamu kelola dari sini.
                            @endif
                        </p>
                    </div>
                    <div class="text-6xl">🅿️</div>
                </div>
            </div>

            <!-- Stat cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @if(Auth::user()->isAdmin())
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-400 flex items-center justify-center text-2xl shadow-md shadow-pink-200">📍</div>
                        <div>
                            <p class="text-slate-400 text-sm">Total Slot</p>
                            <p class="text-2xl font-extrabold text-slate-800">{{ $totalSlot }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-2xl shadow-md shadow-blue-200">🚗</div>
                        <div>
                            <p class="text-slate-400 text-sm">Booking Aktif</p>
                            <p class="text-2xl font-extrabold text-slate-800">{{ $bookingAktif }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-400 flex items-center justify-center text-2xl shadow-md shadow-emerald-200">💳</div>
                        <div>
                            <p class="text-slate-400 text-sm">Total Pendapatan</p>
                            <p class="text-2xl font-extrabold text-slate-800">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @elseif(Auth::user()->isPetugas())
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-400 flex items-center justify-center text-2xl shadow-md shadow-pink-200">📍</div>
                        <div>
                            <p class="text-slate-400 text-sm">Slot Tersedia</p>
                            <p class="text-2xl font-extrabold text-slate-800">{{ $totalSlot }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-2xl shadow-md shadow-blue-200">🚗</div>
                        <div>
                            <p class="text-slate-400 text-sm">Booking Aktif</p>
                            <p class="text-2xl font-extrabold text-slate-800">{{ $bookingAktif }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-400 flex items-center justify-center text-2xl shadow-md shadow-amber-200">🧾</div>
                        <div>
                            <p class="text-slate-400 text-sm">Transaksi Hari Ini</p>
                            <p class="text-2xl font-extrabold text-slate-800">{{ $transaksiHariIni }}</p>
                        </div>
                    </div>
                @elseif(Auth::user()->isOwner())
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-400 flex items-center justify-center text-2xl shadow-md shadow-emerald-200">💳</div>
                        <div>
                            <p class="text-slate-400 text-sm">Total Pendapatan</p>
                            <p class="text-2xl font-extrabold text-slate-800">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-2xl shadow-md shadow-blue-200">✅</div>
                        <div>
                            <p class="text-slate-400 text-sm">Booking Selesai</p>
                            <p class="text-2xl font-extrabold text-slate-800">{{ $bookingSelesai }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-400 flex items-center justify-center text-2xl shadow-md shadow-pink-200">📍</div>
                        <div>
                            <p class="text-slate-400 text-sm">Total Slot</p>
                            <p class="text-2xl font-extrabold text-slate-800">{{ $totalSlot }}</p>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 flex items-center gap-4 sm:col-span-3">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-400 to-slate-300 flex items-center justify-center text-2xl shadow-md">👤</div>
                        <div>
                            <p class="text-slate-400 text-sm">Akun kamu belum memiliki role khusus</p>
                            <p class="text-sm font-semibold text-slate-800">Hubungi admin untuk mengatur akses (Admin/Petugas/Owner).</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Content card -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100">
                @if(Auth::user()->isOwner())
                    <h3 class="font-bold text-lg text-slate-800 mb-2">Rekap Transaksi</h3>
                    <p class="text-slate-500 text-sm mb-4">Lihat rincian pendapatan dan transaksi lengkap.</p>
                    <a href="{{ route('owner.rekap.index') }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md">
                        Lihat Rekap Transaksi →
                    </a>
                @elseif(Auth::user()->isPetugas())
                    <h3 class="font-bold text-lg text-slate-800 mb-2">Transaksi</h3>
                    <p class="text-slate-500 text-sm mb-4">Kelola booking masuk dan cetak struk parkir.</p>
                    <a href="{{ route('petugas.transaksi.index') }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md">
                        Lihat Transaksi →
                    </a>
                @else
                    <h3 class="font-bold text-lg text-slate-800 mb-2">Aktivitas Terbaru</h3>
                    <p class="text-slate-500 text-sm">Belum ada aktivitas untuk ditampilkan di sini.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>