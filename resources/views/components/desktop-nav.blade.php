<nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
        <x-application-logo class="h-12 w-auto"/>
    </div>
    <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 hover:text-gray-500"
                @click="opened = true">
            <span class="sr-only">Open main menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
        </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
        <x-nav-link class="pt-1 text-sm" active="{{ request()->routeIs('movies.index') ? true : '' }}" href="{{ route('movies.index') }}">Movies</x-nav-link>
        <x-nav-link class="pt-1 text-sm" active="{{ request()->routeIs('about') ? true : '' }}" href="{{ route('about') }}">About</x-nav-link>
        <x-nav-link class="pt-1 text-sm" active="{{ request()->routeIs('contact.edit') ? true : '' }}" href="{{ route('contact.edit') }}">Contact</x-nav-link>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        @auth
            <x-nav-link class="mr-10 text-sm" active="{{ request()->routeIs('profile.show.me') ? true : '' }}" href="{{ route('profile.show.me') }}">Profile</x-nav-link>
            <form class="flex items-center" method="POST" action="{{ route('logout') }}">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="px-1 border-b-2 border-transparent text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out">Log out</a>
                @csrf
            </form>
        @endauth
        @guest
                <x-nav-link class="mr-4 text-sm" active="{{ request()->routeIs('login') ? true : '' }}" href="{{ route('login') }}">Log in</x-nav-link>
                <x-nav-link class="text-sm" active="{{ request()->routeIs('register') ? true : '' }}" href="{{ route('register') }}">Register</x-nav-link>
        @endguest
    </div>
</nav>
