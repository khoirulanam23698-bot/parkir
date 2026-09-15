<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            Log Aktivitas
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">No</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">User</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Aktivitas</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Detail</th>
                        <th class="text-left p-4 text-sm font-semibold text-gray-600">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $index => $log)
                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                        <td class="p-4 text-gray-800">{{ $index + 1 }}</td>
                        <td class="p-4 text-gray-800">{{ $log->user }}</td>
                        <td class="p-4 text-gray-600">{{ $log->activity }}</td>
                        <td class="p-4 text-gray-600">{{ $log->details }}</td>
                        <td class="p-4 text-gray-600">{{ $log->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400">Belum ada aktivitas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>