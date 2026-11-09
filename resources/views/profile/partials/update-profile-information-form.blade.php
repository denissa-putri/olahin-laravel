<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="kategori_mhs" :value="__('Kategori (opsional)')" />
            <x-text-input id="kategori_mhs" name="kategori_mhs" type="text" class="mt-1 block w-full" :value="old('kategori_mhs', $user->kategori_mhs)" />
            <x-input-error class="mt-2" :messages="$errors->get('kategori_mhs')" />
        </div>

        <div>
            <x-input-label for="hobi" :value="__('Hobi (opsional)')" />
            <x-text-input id="hobi" name="hobi" type="text" class="mt-1 block w-full" :value="old('hobi', $user->hobi)" />
            <x-input-error class="mt-2" :messages="$errors->get('hobi')" />
        </div>

        <div>
            <x-input-label for="deskripsi" :value="__('Deskripsi (opsional)')" />
            <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('deskripsi', $user->deskripsi) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
