<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl p-6">

                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ $user->profilePhotoUrl() }}" class="w-14 h-14 rounded-full object-cover ring-4 ring-violet-100" alt="">
                    <div>
                        <p class="font-semibold text-slate-700">{{ $user->name }}</p>
                        <p class="text-xs text-slate-400">Bergabung {{ $user->created_at->translatedFormat('d M Y') }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Nama')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password baru (opsional)')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" placeholder="Kosongkan jika tidak ingin diubah" />
                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                    </div>

                    <div>
                        <x-input-label for="role" :value="__('Role')" />
                        <select id="role" name="role" class="mt-1 block w-full rounded-xl border-slate-300 focus:border-violet-500 focus:ring-violet-500 text-sm" required>
                             <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                             <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                             <option value="petugas" {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }}>Petugas</option>
                             <option value="owner" {{ old('role', $user->role) === 'owner' ? 'selected' : '' }}>Owner</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('role')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>