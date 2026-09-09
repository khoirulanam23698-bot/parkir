<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Edit Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl p-6">

                <form method="POST" action="{{ route('vehicles.update', $vehicle) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="plat_nomor" :value="__('Plat Nomor')" />
                        <x-text-input id="plat_nomor" name="plat_nomor" type="text" class="mt-1 block w-full" :value="old('plat_nomor', $vehicle->plat_nomor)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('plat_nomor')" />
                    </div>

                    <div>
                        <x-input-label for="nama_kendaraan" :value="__('Nama Kendaraan (opsional)')" />
                        <x-text-input id="nama_kendaraan" name="nama_kendaraan" type="text" class="mt-1 block w-full" :value="old('nama_kendaraan', $vehicle->nama_kendaraan)" />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_kendaraan')" />
                    </div>

                    <div>
                        <x-input-label for="jenis_kendaraan" :value="__('Jenis Kendaraan')" />
                        <select id="jenis_kendaraan" name="jenis_kendaraan" class="mt-1 block w-full rounded-xl border-slate-300 focus:border-violet-500 focus:ring-violet-500 text-sm" required>
                            <option value="Motor" {{ old('jenis_kendaraan', $vehicle->jenis_kendaraan) === 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Mobil" {{ old('jenis_kendaraan', $vehicle->jenis_kendaraan) === 'Mobil' ? 'selected' : '' }}>Mobil</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('jenis_kendaraan')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                        <a href="{{ route('vehicles.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>