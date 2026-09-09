<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-1 text-gray-800">Semua Booking</h1>
        <p class="text-gray-500 mb-6">Riwayat dan status booking dari semua pengguna</p>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">User</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Slot</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Plat</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $b)
                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                        <td class="p-4 text-gray-800">{{ $b->user->name }}</td>
                        <td class="p-4 font-medium text-gray-800">{{ $b->slot->kode_slot }}</td>
                        <td class="p-4 text-gray-600">{{ $b->plat_kendaraan }}</td>
                        <td class="p-4">
                            <span @class([
                                'px-3 py-1 rounded-full text-xs font-medium',
                                'bg-yellow-100 text-yellow-700' => $b->status === 'booked',
                                'bg-blue-100 text-blue-700' => $b->status === 'aktif',
                                'bg-gray-100 text-gray-600' => $b->status === 'selesai',
                                'bg-red-100 text-red-700' => $b->status === 'dibatalkan',
                            ])>
                                {{ ucfirst($b->status) }}
                            </span>
                        </td>
                        <td class="p-4">
                            @if($b->payment)
                                <span @class([
                                    'px-3 py-1 rounded-full text-xs font-medium',
                                    'bg-green-100 text-green-700' => $b->payment->status === 'lunas',
                                    'bg-orange-100 text-orange-700' => $b->payment->status === 'pending',
                                ])>
                                    {{ ucfirst($b->payment->status) }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400">Belum ada data booking.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>