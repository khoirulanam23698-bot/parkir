<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Kelola Tarif Parkir') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    @if (session('status') === 'tariff-created') Tarif baru berhasil ditambahkan. @endif
                    @if (session('status') === 'tariff-updated') Tarif berhasil diperbarui. @endif
                    @if (session('status') === 'tariff-deleted') Tarif berhasil dihapus. @endif
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Daftar Tarif Parkir</h3>
                        <p class="text-sm text-slate-500">Total {{ $tariffs->total() }} tarif terdaftar</p>
                    </div>
                    <a href="{{ route('admin.tariffs.create') }}" class="bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
                        + Tambah Tarif
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-slate-400 border-b border-slate-100">
                                <th class="pb-3 font-medium">Jenis Kendaraan</th>
                                <th class="pb-3 font-medium">Tarif Awal</th>
                                <th class="pb-3 font-medium">Tarif/Jam Berikutnya</th>
                                <th class="pb-3 font-medium">Status</th>
                                <th class="pb-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tariffs as $tariff)
                                <tr class="border-b border-slate-50">
                                    <td class="py-3 font-medium text-slate-700">{{ $tariff->jenis_kendaraan }}</td>
                                    <td class="py-3 text-slate-500">Rp{{ number_format($tariff->tarif_awal, 0, ',', '.') }}</td>
                                    <td class="py-3 text-slate-500">Rp{{ number_format($tariff->tarif_per_jam, 0, ',', '.') }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $tariff->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                                            {{ $tariff->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('admin.tariffs.edit', $tariff) }}" class="text-slate-500 hover:text-violet-600 text-sm font-medium">Edit</a>
                                        <form action="{{ route('admin.tariffs.destroy', $tariff) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus tarif ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 text-sm font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-slate-400">Belum ada tarif parkir.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $tariffs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>