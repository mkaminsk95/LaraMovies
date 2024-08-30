<x-layout.guest>
    <div class="mb-4 text-sm">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-inputs.label for="password" :value="__('Password')" />

            <x-inputs.text id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-inputs.error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-buttons.primary>
                {{ __('Confirm') }}
            </x-buttons.primary>
        </div>
    </form>
</x-layout-guest>
