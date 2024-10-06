@php
    $sortingOptions = [
            'vote_count.asc' => __('Popularity ascending'),
            'vote_count.desc' => __('Popularity descending'),
            'release_date.asc' => __('Release date ascending'),
            'release_date.desc' => __('Release date descending'),
            'vote_average.asc' => __('Vote average ascending'),
            'vote_average.desc' => __('Vote average descending'),
        ];
@endphp

<form x-show="opened">
    <div class="flex flex-col fixed overflow-auto inset-0 z-10 md:sticky md:top-[30px] md:mb-[135px] md:mt-[57px] pt-8 md:pt-2 pb-6 px-10 h-full md:h-fit md:w-[320px] lg:w-[375px]
            bg-light-element dark:bg-dark-element shadow-lg dark:shadow-shadow-color border border-1 border-gray-300 dark:border-gray-700">
        <div @click="opened = false" class="inline-block md:hidden ml-auto hover:light-text-hover dark:hover:dark-text-hover">
            <svg width="20px" height="20px" viewBox="0 0 1024 1024" fill="currentColor" role="img" style="vertical-align:middle" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path fill="currentColor" fill-rule="evenodd" d="M799.855 166.312c.023.007.043.018.084.059l57.69 57.69c.041.041.052.06.059.084a.118.118 0 0 1 0 .069c-.007.023-.018.042-.059.083L569.926 512l287.703 287.703c.041.04.052.06.059.083a.118.118 0 0 1 0 .07c-.007.022-.018.042-.059.083l-57.69 57.69c-.041.041-.06.052-.084.059a.118.118 0 0 1-.069 0c-.023-.007-.042-.018-.083-.059L512 569.926L224.297 857.629c-.04.041-.06.052-.083.059a.118.118 0 0 1-.07 0c-.022-.007-.042-.018-.083-.059l-57.69-57.69c-.041-.041-.052-.06-.059-.084a.118.118 0 0 1 0-.069c.007-.023.018-.042.059-.083L454.073 512L166.371 224.297c-.041-.04-.052-.06-.059-.083a.118.118 0 0 1 0-.07c.007-.022.018-.042.059-.083l57.69-57.69c.041-.041.06-.052.084-.059a.118.118 0 0 1 .069 0c.023.007.042.018.083.059L512 454.073l287.703-287.702c.04-.041.06-.052.083-.059a.118.118 0 0 1 .07 0Z"/></g></svg>
        </div>

        <x-inputs.label class="mt-6" for="sorting">{{ __('Sorting') }}</x-inputs.label>
        <x-inputs.select id="sorting" name="sorting" :options="$sortingOptions" :value="$query['sorting'] ?? ''"/>

        <hr class="mt-7 border-gray-300 dark:border-gray-700">

        <x-inputs.label class="mt-2" for="title">{{ __('Title') }}</x-inputs.label>
        <x-inputs.text id="title" name="title" :value="$query['title'] ?? ''"/>

        <x-inputs.label class="mt-2" for="title">{{ __('Year') }}</x-inputs.label>
        <x-inputs.select id="year" name="year" :options="range(date('Y'), 1900)" :value="$query['year'] ?? ''"/>

        <x-inputs.label class="mt-2" for="vote_average">{{ __('Vote average') }}</x-inputs.label>
        <x-inputs.select id="vote_average" name="vote_average" :options="range(1, 10)"
                        :value="$query['vote_average'] ?? ''"/>

        <x-inputs.label class="mt-4 mb-2">{{ __('Genre') }}</x-inputs.label>
        <div class="grid grid-cols-2 gap-2 text-sm">
            @foreach($genres as $genre)
                <div class="flex flex-row gap-2 items-center">
                    <input class="h-5 w-5 rounded text-accent-primary focus:ring-0 checked:ring-0" type="checkbox"
                           name="genre[]" id="{{ $genre }}"
                           value="{{ $genre }}" {{ in_array($genre, $query['genre'] ?? []) ? 'checked' : '' }}/>
                    <label class="text-sm" for="{{ $genre }}">{{ __($genre) }}</label>
                </div>
            @endforeach
        </div>
        <x-buttons.primary class="mt-8 mb-6">{{ __('Search') }}</x-buttons.primary>
    </div>
</form>
