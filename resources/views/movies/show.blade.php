<x-layout>
    <div x-data="initializePanel()"  class="flex flex-col mx-auto md:mt-12 md:mb-20 lg:mt-20 w-full md:w-[725px] lg:w-[1000px] bg-white dark:bg-gray-800">

        @include('movies.partials.movie-header')

        <div class="py-10 sm:py-14 md:py-16 lg:py-20 px-6 sm:px-12 md:px-16 lg:px-20">
            @include('movies.partials.movie-body')
        </div>

    </div>
</x-layout>
