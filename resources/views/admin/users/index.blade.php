<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    @if (session('status') === 'user-created') Pengguna baru berhasil ditambahkan. @endif
                    @if (session('status') === 'user-updated') Data pengguna berhasil diperbarui. @endif
                    @if (session('status') === 'user-deleted') Pengguna berhasil dihapus. @endif
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Daftar Pengguna</h3>
                        <p class="text-sm text-slate-500">Total {{ $users->total() }} pengguna terdaftar</p>
                    </div>
                    <a href="{{ route('admin.users.create') }}" class="bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
                        + Tambah User
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-slate-400 border-b border-slate-100">
                                <th class="pb-3 font-medium">Nama</th>
                                <th class="pb-3 font-medium">Email</th>
                                <th class="pb-3 font-medium">Role</th>
                                <th class="pb-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b border-slate-50">
                                    <td class="py-3 flex items-center gap-3">
                                        <img src="{{ $user->profilePhotoUrl() }}" class="w-8 h-8 rounded-full object-cover" alt="">
                                        <span class="font-medium text-slate-700">{{ $user->name }}</span>
                                    </td>
                                    <td class="py-3 text-slate-500">{{ $user->email }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-violet-100 text-violet-700' : 'bg-slate-100 text-slate-600' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-slate-500 hover:text-violet-600 text-sm font-medium">Edit</a>
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-500 hover:text-rose-700 text-sm font-medium">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-slate-400">Belum ada pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>