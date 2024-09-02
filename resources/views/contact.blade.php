<x-layout.base>
    <div class="isolate px-6 py-24 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ __('Contact us') }}</h2>
            <p class="mt-2 text-md leading-8 text-light-text-secondary dark:text-dark-text-secondary">{{ __('Tell us about your ideas, concerns, or anything else you\'d like to share.') }}<br/>{{ __('We\'re here to listen and help!') }}</p>
        </div>
        <form action="/contact" method="POST" class="mx-auto mt-16 max-w-xl sm:mt-20">
            <x-action-status-message/>
            @csrf
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div>
                    <x-inputs.label for="first-name">{{ __('First name') }}</x-inputs.label>
                    <x-inputs.text id="first-name" name="first-name" autocomplete="given-name" required/>
                </div>
                <div>
                    <x-inputs.label for="first-name">{{ __('Last name') }}</x-inputs.label>
                    <x-inputs.text id="last-name" name="last-name" autocomplete="family-name" required/>
                </div>
                <div class="sm:col-span-2">
                    <x-inputs.label for="company">{{ __('Company') }}</x-inputs.label>
                    <x-inputs.text name="company" id="company" autocomplete="organization"/>
                </div>
                <div class="sm:col-span-2">
                    <x-inputs.label for="user-email">{{ __('Email') }}</x-inputs.label>
                    <x-inputs.text name="user-email" id="user-email" autocomplete="email" type="email" required/>
                </div>
                <div class="sm:col-span-2">
                    <x-inputs.label for="message">{{ __('Message') }}</x-inputs.label>
                    <x-inputs.textarea rows="4" name="message" id="message" required/>
                </div>

            </div>
            <div class="mt-10">
                <x-buttons.primary class="box-content w-full mt-6 py-2">{{ __('Let\'s talk') }}</x-buttons.primary>
            </div>
        </form>
    </div>
</x-layout.base>
