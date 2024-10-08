<x-layout.base-with-loader>
    <div class="lg:mt-20 lg:mb-24 lg:mx-auto md:px-8 lg:px-16 shadow-lg lg:w-fit bg-light-element dark:bg-dark-element">
        <div x-data="{opened: window.innerWidth > 768}" @resize.window="opened = window.innerWidth > 768;"
             class="flex flex-col md:flex-row mx-auto justify-center gap-x-9 lg:gap-x-9">

            @include('movies.partials.movies-search')

            <div class="mt-12 lg:mt-16 flex flex-col grow max-w-full lg:max-w-fit">
                <div class="md:hidden pt-3 pb-5 pl-8 md:pl-4 text-md font-medium leading-5 text-light-text-secondary dark:text-dark-text-secondary focus:outline-none transition duration-150 ease-in-out cursor-pointer">
                    <span @click="opened = true"
                        class="border-b-2 border-transparent focus:border-gray-300 dark:focus:border-gray-700 hover:border-gray-300 dark:hover:border-gray-700 hover:text-light-text-hover dark:hover:text-dark-text-hover">{{ __('Search') }}</span>
                </div>

                @include('movies.partials.movies-list')
            </div>
        </div>
    </div>
</x-layout.base-with-loader>
