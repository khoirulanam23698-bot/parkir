<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-1 text-gray-800">Kelola Slot Parkir</h1>
        <p class="text-gray-500 mb-6">Tambah dan kelola data slot parkir</p>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded-lg mb-4 flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="font-semibold text-lg mb-4 text-gray-800">Tambah Slot Baru</h2>

            @if($areas->isEmpty())
                <p class="text-sm text-red-500">Belum ada Area Parkir. Tambahkan area dulu di menu "Area Parkir" sebelum bisa menambah slot.</p>
            @else
                <form action="{{ route('admin.slots.store') }}" method="POST" class="flex flex-wrap gap-3">
                    @csrf
                    <input type="text" name="kode_slot" placeholder="Kode Slot (A1, A2, ...)" class="border border-gray-300 rounded-lg p-2.5 flex-1 min-w-[180px] focus:ring-2 focus:ring-blue-400 focus:outline-none" required>

                    <select name="jenis" class="border border-gray-300 rounded-lg p-5.2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                        <option value="motor">Motor</option>
                        <option value="mobil">Mobil</option>
                    </select>

                    <select name="parking_area_id" class="border border-gray-300 rounded-lg p-5.2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                        <option value="">-- Pilih Area --</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>

                    <button class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2.5 rounded-lg font-medium">
                        + Tambah
                    </button>
                </form>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Kode</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Jenis</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Area</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slots as $slot)
                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                        <td class="p-4 font-medium text-gray-800">{{ $slot->kode_slot }}</td>
                        <td class="p-4 text-gray-600">
                            {{ $slot->jenis === 'motor' ? '🏍️' : '🚗' }} {{ ucfirst($slot->jenis) }}
                        </td>
                        <td class="p-4 text-gray-600">
                            {{ $slot->area->name ?? '-' }}
                        </td>
                        <td class="p-4">
                            <span @class([
                                'px-3 py-1 rounded-full text-xs font-medium',
                                'bg-green-100 text-green-700' => $slot->status === 'tersedia',
                                'bg-red-100 text-red-700' => $slot->status === 'terisi',
                            ])>
                                {{ ucfirst($slot->status) }}
                            </span>
                        </td>
                        <td class="p-4">
                            <form action="{{ route('admin.slots.destroy', $slot) }}" method="POST" onsubmit="return confirm('Yakin hapus slot ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 text-sm font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400">Belum ada slot parkir. Tambahkan di atas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>