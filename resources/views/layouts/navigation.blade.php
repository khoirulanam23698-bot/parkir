<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-600 to-blue-500 flex items-center justify-center text-white font-bold shadow-md">P</div>
                        <span class="font-extrabold text-lg bg-gradient-to-r from-violet-600 to-blue-500 bg-clip-text text-transparent">Parkir Kabasa</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                        {{ request()->routeIs('dashboard')
                            ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                            : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                        Dashboard
                    </a>

                    @if(Auth::user()->isAdmin())
                        <a href="{{ Route::has('admin.slots.index') ? route('admin.slots.index') : '#' }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                            {{ request()->routeIs('admin.slots.*')
                                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                            Kelola Slot
                        </a>
                        <a href="{{ Route::has('admin.bookings.index') ? route('admin.bookings.index') : '#' }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                            {{ request()->routeIs('admin.bookings.*')
                                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                            Semua Booking
                        </a>
                        <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                            {{ request()->routeIs('admin.users.*')
                                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                            Kelola User
                        </a>
                        <a href="{{ Route::has('admin.areas.index') ? route('admin.areas.index') : '#' }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                            {{ request()->routeIs('admin.areas.*')
                                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                            Area Parkir
                        </a>
                        <a href="{{ Route::has('admin.tariffs.index') ? route('admin.tariffs.index') : '#' }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                            {{ request()->routeIs('admin.tariffs.*')
                                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                            Tarif Parkir
                        </a>
                        <a href="{{ route('vehicles.index') }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                            {{ request()->routeIs('vehicles.*')
                                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                            Kendaraan
                        </a>
                        <a href="{{ Route::has('admin.activity_logs') ? route('admin.activity_logs') : '#' }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                            {{ request()->routeIs('admin.activity_logs')
                                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                            Log Aktifitas
                        </a>
                    @endif

                    @if(Auth::user()->isPetugas())
                        <a href="{{ Route::has('petugas.transaksi.index') ? route('petugas.transaksi.index') : '#' }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                            {{ request()->routeIs('petugas.transaksi.*')
                                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                            Transaksi
                        </a>
                    @endif

                    @if(Auth::user()->isOwner())
                        <a href="{{ Route::has('owner.rekap.index') ? route('owner.rekap.index') : '#' }}"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition
                            {{ request()->routeIs('owner.rekap.*')
                                ? 'bg-gradient-to-r from-violet-600 to-blue-500 text-white shadow-md'
                                : 'text-slate-600 hover:bg-violet-50 hover:text-violet-600' }}">
                            Rekap Transaksi
                        </a>
                    @endif
                </div>
            </div>

            <!-- User dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <span class="text-sm text-slate-500">{{ Auth::user()->name }}</span>
                <span class="px-3 py-1 rounded-full bg-violet-100 text-violet-700 text-xs font-bold">
                    {{ Auth::user()->role ?? 'Admin' }}
                </span>

                <div x-data="{ userOpen: false }" class="relative">
                    <button @click="userOpen = !userOpen" class="flex items-center gap-1 px-2 py-2 rounded-full hover:bg-slate-100 transition">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-violet-500 to-blue-400 flex items-center justify-center text-white text-sm font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>

                    <div x-show="userOpen" @click.away="userOpen = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-violet-50 hover:text-violet-600 transition">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-rose-500 hover:bg-rose-50 transition">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-100">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-violet-50 text-violet-700' : 'text-slate-600' }}">Dashboard</a>

            @if(Auth::user()->isAdmin())
                <a href="{{ Route::has('admin.slots.index') ? route('admin.slots.index') : '#' }}" class="block px-4 py-2 rounded-xl text-sm font-semibold">Kelola Slot</a>
                <a href="{{ Route::has('admin.bookings.index') ? route('admin.bookings.index') : '#' }}" class="block px-4 py-2 rounded-xl text-sm font-semibold">Semua Booking</a>
                <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}" class="block px-4 py-2 rounded-xl text-sm font-semibold">Kelola User</a>
                <a href="{{ Route::has('admin.areas.index') ? route('admin.areas.index') : '#' }}" class="block px-4 py-2 rounded-xl text-sm font-semibold">Area Parkir</a>
                <a href="{{ Route::has('admin.tariffs.index') ? route('admin.tariffs.index') : '#' }}" class="block px-4 py-2 rounded-xl text-sm font-semibold">Tarif Parkir</a>
                <a href="{{ route('vehicles.index') }}" class="block px-4 py-2 rounded-xl text-sm font-semibold">Kendaraan</a>
                <a href="{{ Route::has('admin.activity_logs') ? route('admin.activity_logs') : '#' }}" class="block px-4 py-2 rounded-xl text-sm font-semibold">Log Aktifitas</a>
            @endif

            @if(Auth::user()->isPetugas())
                <a href="{{ Route::has('petugas.transaksi.index') ? route('petugas.transaksi.index') : '#' }}" class="block px-4 py-2 rounded-xl text-sm font-semibold">Transaksi</a>
            @endif

            @if(Auth::user()->isOwner())
                <a href="{{ Route::has('owner.rekap.index') ? route('owner.rekap.index') : '#' }}" class="block px-4 py-2 rounded-xl text-sm font-semibold">Rekap Transaksi</a>
            @endif
        </div>
        <div class="pt-4 pb-3 border-t border-slate-100 px-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-500 to-blue-400 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-semibold text-slate-800 text-sm">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-violet-50">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 rounded-xl text-sm text-rose-500 hover:bg-rose-50">Log Out</button>
            </form>
        </div>
    </div>
</nav>