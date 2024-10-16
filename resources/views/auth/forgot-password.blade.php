<x-layout.guest>
    <div class="mb-4 text-sm">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-inputs.label for="email" :value="__('Email')" />
            <x-inputs.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-inputs.error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-buttons.primary>
                {{ __('Email Password Reset Link') }}
            </x-buttons.primary>
        </div>
    </form>
</x-layout-guest>
