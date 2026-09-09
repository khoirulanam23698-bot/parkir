<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Tambah Area Parkir') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl p-6">

                <form method="POST" action="{{ route('admin.areas.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Area')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" placeholder="Contoh: Lantai 1" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="code" :value="__('Kode Area')" />
                        <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" :value="old('code')" placeholder="Contoh: L1" required />
                        <x-input-error class="mt-2" :messages="$errors->get('code')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Deskripsi (opsional)')" />
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-xl border-slate-300 focus:border-violet-500 focus:ring-violet-500 text-sm">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        <a href="{{ route('admin.areas.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>