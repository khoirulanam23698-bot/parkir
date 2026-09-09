<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Edit Tarif Parkir') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl p-6">

                <form method="POST" action="{{ route('admin.tariffs.update', $tariff) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="jenis_kendaraan" :value="__('Jenis Kendaraan')" />
                        <x-text-input id="jenis_kendaraan" name="jenis_kendaraan" type="text" class="mt-1 block w-full" :value="old('jenis_kendaraan', $tariff->jenis_kendaraan)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('jenis_kendaraan')" />
                    </div>

                    <div>
                        <x-input-label for="tarif_awal" :value="__('Tarif Awal (Rp) - Jam Pertama')" />
                        <x-text-input id="tarif_awal" name="tarif_awal" type="number" min="0" class="mt-1 block w-full" :value="old('tarif_awal', $tariff->tarif_awal)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('tarif_awal')" />
                    </div>

                    <div>
                        <x-input-label for="tarif_per_jam" :value="__('Tarif per Jam Berikutnya (Rp)')" />
                        <x-text-input id="tarif_per_jam" name="tarif_per_jam" type="number" min="0" class="mt-1 block w-full" :value="old('tarif_per_jam', $tariff->tarif_per_jam)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('tarif_per_jam')" />
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $tariff->is_active) ? 'checked' : '' }} class="rounded border-slate-300 text-violet-600 focus:ring-violet-500">
                        <label for="is_active" class="text-sm text-slate-600">Aktifkan tarif ini</label>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                        <a href="{{ route('admin.tariffs.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>