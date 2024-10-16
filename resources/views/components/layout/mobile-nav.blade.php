<!-- Mobile menu, show/hide based on menu open state. -->
<div class="lg:hidden" role="dialog" aria-modal="true" x-show="opened">
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div class="fixed inset-0 z-50"></div>
    <div
        class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white dark:bg-dark-element px-6 py-6 sm:max-w-sm border border-gray-300 dark:border-gray-700">
        <div class="text-right">
            <button @click="opened = false" type="button" class="-m-2.5 rounded-md p-2.5">
                <span class="sr-only">{{ __('Close menu') }}</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="mt-6">
            <div class="-my-6 divide-y divide-gray-500/10">
                <div class="space-y-2 py-6">
                    <x-layout.nav-link class="block py-2 text-base leading-7" active="{{ request()->routeIs('movies.index') ? true : '' }}" href="{{ route('movies.index') }}">{{ __('Movies') }}</x-layout.nav-link>
                    <x-layout.nav-link class="block py-2 text-base leading-7" active="{{ request()->routeIs('recommendations') ? true : '' }}" href="{{ route('recommendations') }}">{{ __('AI Recommendations') }}</x-layout.nav-link>
                    <x-layout.nav-link class="block py-2 text-base leading-7" active="{{ request()->routeIs('about') ? true : '' }}" href="{{ route('about') }}">{{ __('About us') }}</x-layout.nav-link>
                    <x-layout.nav-link class="block py-2 text-base leading-7" active="{{ request()->routeIs('contact.edit') ? true : '' }}" href="{{ route('contact.edit') }}">{{ __('Contact') }}</x-layout.nav-link>
                </div>
                <div class="space-y-2 py-6">
                    @auth
                        <x-layout.nav-link class="block mr-4 py-2" active="{{ request()->routeIs('profile.show.me') ? true : '' }}" href="{{ route('profile.show.me') }}">{{ __('Profile') }}</x-layout.nav-link>
                        <form class="block" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="block items-center py-2 px-1 pt-1 border-b-2 border-transparent text-base font-medium leading-7 hover:text-light-text-hover dark:hover:text-dark-text-hover hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out">Log out</a>
                        </form>
                    @endauth
                    @guest
                        <x-layout.nav-link class="block py-2 text-base leading-7" active="{{ request()->routeIs('login') ? true : '' }}" href="{{ route('login') }}">{{ __('Log in') }}</x-layout.nav-link>
                        <x-layout.nav-link class="block py-2 text-base leading-7" active="{{ request()->routeIs('register') ? true : '' }}" href="{{ route('register') }}">{{ __('Register') }}</x-layout.nav-link>
                    @endguest
                </div>
            </div>
        </div>
        <div class="absolute flex flex-row items-center gap-3 top-7 left-7 lg:hidden">
            <x-buttons.theme-switcher/>
            <x-buttons.language-switcher btnClass="bg-white" flagSize="24"/>
        </div>
    </div>
</div>
