<!-- Sidebar -->
<aside
    x-cloak
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-100 flex flex-col transition-transform duration-200 ease-in-out">

    <!-- Logo -->
    <div class="h-16 flex items-center gap-2 px-5 border-b border-slate-100 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-600 to-blue-500 flex items-center justify-center text-white font-bold shadow-md">P</div>
            <span class="font-extrabold text-lg bg-gradient-to-r from-violet-600 to-blue-500 bg-clip-text text-transparent">Parkir Kabasa</span>
        </a>
    </div>

    <!-- Nav links -->
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
            {{ request()->routeIs('dashboard')
                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
            <span>📊</span> Dashboard
        </a>

        @if(Auth::user()->isAdmin())
            <p class="px-3 pt-4 pb-1 text-xs font-bold text-slate-400 uppercase tracking-wide">Manajemen</p>

            <a href="{{ Route::has('admin.slots.index') ? route('admin.slots.index') : '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('admin.slots.*')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>🅿️</span> Kelola Slot
            </a>
            <a href="{{ Route::has('admin.bookings.index') ? route('admin.bookings.index') : '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('admin.bookings.*')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>🚗</span> Semua Booking
            </a>
            <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('admin.users.*')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>👤</span> Kelola User
            </a>
            <a href="{{ Route::has('admin.areas.index') ? route('admin.areas.index') : '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('admin.areas.*')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>📍</span> Area Parkir
            </a>
            <a href="{{ Route::has('admin.tariffs.index') ? route('admin.tariffs.index') : '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('admin.tariffs.*')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>💰</span> Tarif Parkir
            </a>
            <a href="{{ route('vehicles.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('vehicles.*')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>🚙</span> Kendaraan
            </a>
            <a href="{{ Route::has('admin.activity_logs') ? route('admin.activity_logs') : '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('admin.activity_logs')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>📝</span> Log Aktifitas
            </a>
        @endif

        @if(!Auth::user()->isAdmin() && !Auth::user()->isPetugas() && !Auth::user()->isOwner())
            <p class="px-3 pt-4 pb-1 text-xs font-bold text-slate-400 uppercase tracking-wide">Layanan</p>
            <a href="{{ Route::has('booking.index') ? route('booking.index') : '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('booking.*')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>🚗</span> Booking
            </a>
        @endif

        @if(Auth::user()->isPetugas())
            <p class="px-3 pt-4 pb-1 text-xs font-bold text-slate-400 uppercase tracking-wide">Operasional</p>
            <a href="{{ Route::has('petugas.transaksi.index') ? route('petugas.transaksi.index') : '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('petugas.transaksi.*')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>🧾</span> Transaksi
            </a>
        @endif

        @if(Auth::user()->isOwner())
            <p class="px-3 pt-4 pb-1 text-xs font-bold text-slate-400 uppercase tracking-wide">Laporan</p>
            <a href="{{ Route::has('owner.rekap.index') ? route('owner.rekap.index') : '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('owner.rekap.*')
                    ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                    : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                <span>📈</span> Rekap Transaksi
            </a>
        @endif
    </nav>

    <!-- User area (bottom) -->
    <div class="border-t border-slate-100 p-4 shrink-0">
        <div x-data="{ userOpen: false }" class="relative">
            <button @click="userOpen = !userOpen" class="w-full flex items-center gap-3 px-2 py-2 rounded-xl hover:bg-slate-100 transition">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-violet-500 to-blue-400 flex items-center justify-center text-white text-sm font-bold shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0 text-left">
                    <div class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</div>
                    <span class="inline-block px-2 py-0.5 rounded-full bg-violet-100 text-violet-700 text-xs font-bold">
                        {{ Auth::user()->role ?? 'User' }}
                    </span>
                </div>
                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>

            <div x-show="userOpen" @click.away="userOpen = false" x-transition
                class="absolute bottom-full left-0 mb-2 w-full bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50" style="display: none;">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-violet-50 hover:text-violet-600 transition">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-rose-500 hover:bg-rose-50 transition">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</aside>