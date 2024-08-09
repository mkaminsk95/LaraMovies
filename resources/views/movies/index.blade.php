<x-layout>
    <div x-data="{opened: window.innerWidth > 768}" @resize.window="opened = window.innerWidth > 768;"
         class="flex flex-col md:flex-row mx-1 sm:mx-32 md:mx-20 justify-center gap-x-4 lg:gap-x-8">

        @include('movies.partials.movies-search')

        <div class="mt-12 flex flex-col grow max-w-full md:max-w-[400px] lg:max-w-[500px]">
            <div class="md:hidden pt-3 pb-5 pl-4 text-sm font-medium leading-5 text-gray-500 dark:text-gray-400  focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 transition duration-150 ease-in-out cursor-pointer">
                <span @click="opened = true" class="border-b-2 border-transparent focus:border-gray-300 dark:focus:border-gray-700 hover:border-gray-300 dark:hover:border-gray-700 hover:text-gray-700 dark:hover:text-gray-300">Search</span>
            </div>

            @include('movies.partials.movies-list')
        </div>
    </div>
</x-layout>
