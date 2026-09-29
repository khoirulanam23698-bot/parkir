<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-1 text-gray-800">🅿️ Parkir Kabasa</h1>
        <p class="text-gray-500 mb-6">Pilih slot dan booking parkir kendaraanmu</p>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded-lg mb-4 flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg mb-4 flex items-center gap-2">
                <span>⚠️</span> {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="font-semibold text-lg mb-4 text-gray-800">Booking Slot Baru</h2>
            <form action="{{ route('booking.store') }}" method="POST" class="grid sm:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Pilih Slot</label>
                    <select name="parking_slot_id" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                        <option value="">-- Pilih Slot --</option>
                        @foreach($slots as $slot)
                            <option value="{{ $slot->id }}">{{ $slot->kode_slot }} ({{ ucfirst($slot->jenis) }}) - {{ $slot->area->name ?? 'Tanpa Area' }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Plat Kendaraan</label>
                    <input type="text" name="plat_kendaraan" placeholder="Contoh: N 1234 AB" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Kendaraan (opsional)</label>
                    <input type="text" name="nama_kendaraan" placeholder="Contoh: Honda Beat" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div class="flex items-end">
                    <button class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2.5 rounded-lg font-medium w-full sm:w-auto">
                        Booking Sekarang
                    </button>
                </div>
            </form>
        </div>

        <h2 class="font-semibold text-lg mb-4 text-gray-800">Booking Saya</h2>

        @if($myBookings->isEmpty())
            <div class="bg-white rounded-xl border border-dashed border-gray-300 p-8 text-center text-gray-400">
                Belum ada booking. Yuk booking slot parkir pertamamu di atas!
            </div>
        @else
        <div class="grid sm:grid-cols-2 gap-4">
            @foreach($myBookings as $b)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <div class="font-bold text-lg text-gray-800">{{ $b->slot->kode_slot }}</div>
                        <div class="text-sm text-gray-500">{{ $b->plat_kendaraan }} @if($b->nama_kendaraan) • {{ $b->nama_kendaraan }} @endif</div>
                    </div>
                    <span @class([
                        'px-3 py-1 rounded-full text-xs font-medium',
                        'bg-yellow-100 text-yellow-700' => $b->status === 'booked',
                        'bg-blue-100 text-blue-700' => $b->status === 'aktif',
                        'bg-gray-100 text-gray-600' => $b->status === 'selesai',
                        'bg-red-100 text-red-700' => $b->status === 'dibatalkan',
                    ])>
                        {{ ucfirst($b->status) }}
                    </span>
                </div>

                <div class="flex justify-between items-center text-sm border-t border-gray-100 pt-3">
                    <div class="text-gray-600">
                        Rp{{ number_format($b->payment->jumlah) }}
                        <span @class([
                            'ml-1 px-2 py-0.5 rounded-full text-xs',
                            'bg-green-100 text-green-700' => $b->payment->status === 'lunas',
                            'bg-orange-100 text-orange-700' => $b->payment->status === 'pending',
                        ])>{{ ucfirst($b->payment->status) }}</span>
                    </div>
                    <div class="flex gap-2">
                        @if($b->payment->status === 'pending')
                        <form action="{{ route('booking.pay', $b) }}" method="POST" class="flex gap-1">
                            @csrf
                            <select name="metode" class="border border-gray-300 rounded text-xs px-3">
                                <option value="tunai">Tunai</option>
                                <option value="transfer">Transfer</option>
                                <option value="qris">QRIS</option>
                            </select>
                            <button class="text-blue-600 text-xs font-medium hover:underline">Bayar</button>
                            @endif
                        @if($b->status === 'aktif')
                        <form action="{{ route('booking.checkout', $b) }}" method="POST">
                            @csrf
                            <button class="text-red-600 text-xs font-medium hover:underline">Checkout</button>
                        </form>
                        @endif
                        </form>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>