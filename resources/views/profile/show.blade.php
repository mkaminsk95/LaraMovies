<x-layout.base>
    <div class="bg-light-element dark:bg-dark-element shadow-lg flex flex-col mx-auto md:mb-20 pb-12 md:mt-12 lg:mt-10 w-full md:w-[725px] lg:w-[1000px] rounded">
        <x-action-status-message/>

        @include('profile.partials.profile-header')

        @include('profile.partials.profile-statistics')

        <div class="px-4 sm:px-2 md:px-8 pt-10">
            @include('profile.partials.profile-movies')
        </div>
    </div>
</x-layout.base>
