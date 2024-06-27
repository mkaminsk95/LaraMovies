<nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
    <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 p-1.5 hover:animate-spin">
            <span class="sr-only">Your Company</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
        </a>
    </div>
    <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
        </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
        <a href="{{ route('movies.index') }}" class="text-m hover:text-gray-500 font-semibold leading-6">Movies</a>
        <a href="#" class="text-m hover:text-gray-500 font-semibold leading-6">About</a>
        <a href="#" class="text-m hover:text-gray-500 font-semibold leading-6">News</a>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        @auth
            <a href="{{route('profile.edit')}}" class="mr-6 text-base hover:text-gray-500 font-semibold leading-6">Edit</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="text-base hover:text-gray-500 font-semibold leading-6">Log out</a>
            </form>
        @endauth
        @guest
            <a href="{{route('login')}}" class="mr-6 text-base hover:text-gray-500 font-semibold leading-6">Log in</a>
            <a href="{{route('register')}}" class="text-base hover:text-gray-500 font-semibold leading-6">Register</a>
        @endguest
    </div>
</nav>
