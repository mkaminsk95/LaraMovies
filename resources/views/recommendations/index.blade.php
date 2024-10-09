<x-layout.base-with-loader>
    <div class="lg:pt-20">
        <div
            class="flex flex-col mx-auto md:mb-20 p-4 md:p-8 w-full lg:w-[1000px] bg-white dark:bg-dark-element shadow-lg">
            <x-message id="message" class="mt-5 hidden" type="error" messages="test"></x-message>

            <div class="mx-auto pt-6 max-w-2xl text-center">
                <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ __('AI Recommendations') }}</h1>
                @auth
                    <p class="mt-2 text-md leading-8 text-light-text-secondary dark:text-dark-text-secondary">{{ __('Here you can receive personalized movie recommendations based on your input and titles you rated.') }}
                        <br/>{{ __('It\'s a quick and easy way to discover new movies!') }}</p>
                @endauth
                @guest
                    <p class="mt-2 text-md leading-8 text-light-text-secondary dark:text-dark-text-secondary">{{ __('Here you can receive personalized movie recommendations based on your input.') }}
                        <br/>{{ __('It\'s a quick and easy way to discover new movies!') }}</p>
                @endguest
                @guest
                    <div class="mt-3">
                        <p class="text-light-text-secondary dark:text-dark-text-secondary">
                            <a href="{{ route('login') }}" class="text-light-text-primary dark:text-dark-text-primary tracking-wide hover:text-light-text-hover hover:dark:text-dark-text-hover cursor-pointer">{{ __('Log in') }}</a>
                            {{ __('to get more personalized results using your movie ratings.') }}</p>
                    </div>
                @endguest
            </div>



            @include('recommendations.partials.form')

            @include('recommendations.partials.recommendations-results')
        </div>
    </div>
    @vite('resources/js/message.js')
</x-layout.base-with-loader>
