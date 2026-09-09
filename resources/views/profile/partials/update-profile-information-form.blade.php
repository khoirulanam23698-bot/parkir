<section>
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-slate-800">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __("Update your account's profile information and photo.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex items-center gap-6" x-data="{ preview: null }">
            <div class="relative">
                <img
                    x-show="!preview"
                    src="{{ $user->profilePhotoUrl() }}"
                    class="w-24 h-24 rounded-full object-cover ring-4 ring-violet-100"
                    alt="Foto profil"
                >
                <img
                    x-show="preview"
                    :src="preview"
                    class="w-24 h-24 rounded-full object-cover ring-4 ring-violet-100"
                    style="display: none;"
                >
                <label for="photo" class="absolute bottom-0 right-0 bg-violet-600 hover:bg-violet-700 text-white rounded-full p-2 cursor-pointer shadow-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828H9V13z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 19h14" />
                    </svg>
                </label>
                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/*"
                    class="hidden"
                    @change="
                        const file = $event.target.files[0];
                        if (file) { preview = URL.createObjectURL(file); }
                    "
                >
            </div>
            <div>
                <p class="text-sm font-medium text-slate-700">{{ $user->name }}</p>
                <p class="text-xs text-slate-400 mt-1">JPG, PNG maks. 2MB</p>
                @error('photo')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-slate-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-slate-600 hover:text-slate-900 rounded-md">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>