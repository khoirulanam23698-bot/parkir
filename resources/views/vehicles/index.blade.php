<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Kendaraan Saya') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    @if (session('status') === 'vehicle-created') Kendaraan baru berhasil ditambahkan. @endif
                    @if (session('status') === 'vehicle-updated') Data kendaraan berhasil diperbarui. @endif
                    @if (session('status') === 'vehicle-deleted') Kendaraan berhasil dihapus. @endif
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Daftar Kendaraan</h3>
                        <p class="text-sm text-slate-500">Total {{ $vehicles->total() }} kendaraan terdaftar</p>
                    </div>
                    <a href="{{ route('vehicles.create') }}" class="bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
                        + Tambah Kendaraan
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-slate-400 border-b border-slate-100">
                                <th class="pb-3 font-medium">Plat Nomor</th>
                                <th class="pb-3 font-medium">Nama Kendaraan</th>
                                <th class="pb-3 font-medium">Jenis</th>
                                <th class="pb-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicles as $vehicle)
                                <tr class="border-b border-slate-50">
                                    <td class="py-3 font-medium text-slate-700">{{ $vehicle->plat_nomor }}</td>
                                    <td class="py-3 text-slate-500">{{ $vehicle->nama_kendaraan ?? '-' }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-violet-100 text-violet-700">
                                            {{ $vehicle->jenis_kendaraan }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="text-slate-500 hover:text-violet-600 text-sm font-medium">Edit</a>
                                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 text-sm font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-slate-400">Belum ada kendaraan terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $vehicles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>