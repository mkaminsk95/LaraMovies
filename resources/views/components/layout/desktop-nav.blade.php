<nav class="mx-auto flex max-w-[900px] xl:max-w-[1100px] 2xl:max-w-[1250px] items-center justify-between p-6" aria-label="Global">
    <div class="flex lg:flex-1">
        <x-application-logo class="h-12 w-auto"/>
    </div>
    <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 hover:text-light-text-hover dark:hover:text-dark-text-hover"
                @click="opened = true">
            <span class="sr-only">{{ __('Open main menu') }}</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
        </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
        <x-layout.nav-link class="pt-1 text-sm" active="{{ request()->routeIs('movies.index') ? true : '' }}" href="{{ route('movies.index') }}">{{ __('Movies') }}</x-layout.nav-link>
        <x-layout.nav-link class="pt-1 text-sm" active="{{ request()->routeIs('about') ? true : '' }}" href="{{ route('about') }}">{{ __('About us') }}</x-layout.nav-link>
        <x-layout.nav-link class="pt-1 text-sm" active="{{ request()->routeIs('contact.edit') ? true : '' }}" href="{{ route('contact.edit') }}">{{ __('Contact') }}</x-layout.nav-link>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        @auth
            <x-layout.nav-link class="mr-10 text-sm" active="{{ request()->routeIs('profile.show.me') ? true : '' }}" href="{{ route('profile.show.me') }}">{{ __('Profile') }}</x-layout.nav-link>
            <form class="flex items-center" method="POST" action="{{ route('logout') }}">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="px-1 border-b-2 border-transparent text-sm font-medium hover:text-light-text-hover dark:hover:text-dark-text-hover hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out">{{ __('Log out') }}</a>
                @csrf
            </form>
        @endauth
        @guest
                <x-layout.nav-link class="mr-4 text-sm" active="{{ request()->routeIs('login') ? true : '' }}" href="{{ route('login') }}">{{ __('Log in') }}</x-layout.nav-link>
                <x-layout.nav-link class="text-sm" active="{{ request()->routeIs('register') ? true : '' }}" href="{{ route('register') }}">{{ __('Register') }}</x-layout.nav-link>
        @endguest
    </div>
    <div class="absolute right-5 flex flex-col items-center gap-2 p-1 rounded max-lg:hidden">
        <x-buttons.theme-switcher/>
        <x-buttons.language-switcher/>
    </div>
</nav>
