<x-layout.base>
    <x-action-status-message/>
    <div x-data="initializePanel()"  class="flex flex-col mx-auto md:mt-16 md:mb-20 lg:mt-20 w-full max-lg:max-w-[800px] lg:w-[1000px] bg-white dark:bg-dark-element shadow-lg">

        @include('movies.partials.movie-header')

        <div class="bg-light-element dark:bg-dark-element py-10 sm:py-14 md:py-16 lg:py-20 px-6 sm:px-12 md:px-16 lg:px-20">
            @include('movies.partials.movie-body')
        </div>

    </div>
</x-layout.base>
