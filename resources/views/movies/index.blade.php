<x-layout>
    <div x-data="{opened: window.innerWidth > 768}" @resize.window="opened = window.innerWidth > 768;"
         class="flex flex-col md:flex-row mx-1 sm:mx-32 md:mx-20 justify-center gap-x-4 lg:gap-x-8">
        <form x-show="opened">
            <div class="flex flex-col fixed inset-0 z-10 md:sticky md:top-12 md:mt-[52px] pt-8 md:pt-2 pb-6 px-10 h-full md:h-fit md:w-[320px] lg:w-[350px]
            bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-300 rounded border border-1 border-gray-300 dark:border-gray-700">
                <div @click="opened = false" class="inline-block md:hidden ml-auto hover:text-gray-500">
                    <svg width="20px" height="20px" viewBox="0 0 1024 1024" fill="currentColor" role="img" style="vertical-align:middle" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path fill="currentColor" fill-rule="evenodd" d="M799.855 166.312c.023.007.043.018.084.059l57.69 57.69c.041.041.052.06.059.084a.118.118 0 0 1 0 .069c-.007.023-.018.042-.059.083L569.926 512l287.703 287.703c.041.04.052.06.059.083a.118.118 0 0 1 0 .07c-.007.022-.018.042-.059.083l-57.69 57.69c-.041.041-.06.052-.084.059a.118.118 0 0 1-.069 0c-.023-.007-.042-.018-.083-.059L512 569.926L224.297 857.629c-.04.041-.06.052-.083.059a.118.118 0 0 1-.07 0c-.022-.007-.042-.018-.083-.059l-57.69-57.69c-.041-.041-.052-.06-.059-.084a.118.118 0 0 1 0-.069c.007-.023.018-.042.059-.083L454.073 512L166.371 224.297c-.041-.04-.052-.06-.059-.083a.118.118 0 0 1 0-.07c.007-.022.018-.042.059-.083l57.69-57.69c.041-.041.06-.052.084-.059a.118.118 0 0 1 .069 0c.023.007.042.018.083.059L512 454.073l287.703-287.702c.04-.041.06-.052.083-.059a.118.118 0 0 1 .07 0Z"/></g></svg>
                </div>

                <x-input-label for="title">Title</x-input-label>
                <x-text-input id="title" name="title" :value="$query['title'] ?? ''"/>

                <x-input-label for="title">Year</x-input-label>
                <x-select-input id="year" name="year" :options="range(date('Y'), 1900)" :value="$query['year'] ?? ''"/>

                <x-input-label for="vote_average">Vote average</x-input-label>
                <x-select-input id="vote_average" name="vote_average" :options="range(1, 10)" :value="$query['vote_average'] ?? ''"/>

                <span class="mt-8 mb-2 pl-2 text-xs font-semibold">Genre</span>
                <div class="grid grid-cols-2 gap-1 text-sm">
                    @foreach($genres as $genre)
                        <div class="h-6">
                            <input class="rounded text-primary focus:ring-0 checked:ring-0" type="checkbox"
                                   name="genre[]" id="{{ $genre }}" value="{{ $genre }}" {{ in_array($genre, $query['genre'] ?? []) ? 'checked' : '' }}/>
                            <label class="text-xs" for="{{ $genre }}">{{ $genre }}</label>
                        </div>
                    @endforeach
                </div>
                <x-primary-button class="mt-8 mb-6">Search</x-primary-button>
            </div>
        </form>
        <div class="mt-12 flex flex-col grow max-w-full md:max-w-[400px] lg:max-w-[500px]">
            <div class="md:hidden pt-3 pb-5 pl-4 text-sm font-medium leading-5 text-gray-500 dark:text-gray-400  focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 transition duration-150 ease-in-out cursor-pointer">
                <span @click="opened = true" class="border-b-2 border-transparent focus:border-gray-300 dark:focus:border-gray-700 hover:border-gray-300 dark:hover:border-gray-700 hover:text-gray-700 dark:hover:text-gray-300">Search</span>
            </div>

            @include('movies.partials.movies-list')
        </div>
    </div>
</x-layout>
