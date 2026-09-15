<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-slate-800 mb-6">Rekap Transaksi</h1>

        <form method="GET" class="flex flex-wrap items-end gap-3 mb-6 bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">Dari Tanggal</label>
                <input type="date" name="dari" value="{{ $dari }}" class="rounded-lg border-slate-200 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">Sampai Tanggal</label>
                <input type="date" name="sampai" value="{{ $sampai }}" class="rounded-lg border-slate-200 text-sm">
            </div>
            <button type="submit" class="px-4 py-2 rounded-full bg-gradient-to-r from-violet-600 to-blue-500 text-white text-sm font-semibold shadow-md">
                Filter
            </button>
        </form>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-6">
            <div class="text-sm text-slate-500">Total Pendapatan (Lunas)</div>
            <div class="text-2xl font-bold text-emerald-600">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">No. Booking</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Plat</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Waktu Masuk</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Metode Bayar</th>
                        <th class="text-right px-4 py-3 font-semibold text-slate-600">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-t border-slate-100">
                            <td class="px-4 py-3">#{{ $booking->id }}</td>
                            <td class="px-4 py-3">{{ $booking->plat_kendaraan }}</td>
                            <td class="px-4 py-3">{{ optional($booking->waktu_masuk)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">{{ ucfirst($booking->status) }}</td>
                            <td class="px-4 py-3">{{ $booking->payment->metode ?? '-' }}</td>
                            <td class="px-4 py-3 text-right">Rp{{ number_format($booking->payment->jumlah ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-slate-400">Tidak ada transaksi pada rentang ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>