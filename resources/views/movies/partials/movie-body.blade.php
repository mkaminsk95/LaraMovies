@php
    $locale = app()->getLocale();
@endphp
<div x-data="{togglePoster: false, toggleMagnifierIcon: false}" class="flex flex-row">
    @include('movies.partials.poster-magnified')

    <div class="w-[80px] min-[500px]:w-[110px] sm:w-[200px] sm:min-w-[80px] sm:max-w-[200px] md:max-w-full lg:basis-1/4">
        @if($movie['poster_path'] !== null)
            <div @click="togglePoster = true"
                 @mouseenter="toggleMagnifierIcon = true"
                 @mouseleave="toggleMagnifierIcon = false"
                 class="relative">
                <div x-show="toggleMagnifierIcon"
                     x-transition.opacity.duration.400ms
                     class="transition h-full w-full absolute bg-gray-300/50 flex items-center justify-center">
                        <svg class="w-14" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M27.414,24.586l-5.077-5.077C23.386,17.928,24,16.035,24,14c0-5.514-4.486-10-10-10S4,8.486,4,14  s4.486,10,10,10c2.035,0,3.928-0.614,5.509-1.663l5.077,5.077c0.78,0.781,2.048,0.781,2.828,0  C28.195,26.633,28.195,25.367,27.414,24.586z M7,14c0-3.86,3.14-7,7-7s7,3.14,7,7s-3.14,7-7,7S7,17.86,7,14z" id="XMLID_223_"/></svg>
                </div>
                <img class="flex-none bg-gray-50 rounded"
                     src="https://image.tmdb.org/t/p/w780{{ $movie['poster_path'] }}"
                     alt="{{ __('poster') }}">
            </div>
        @else
            <img src="https://dummyimage.com/780x1170/d2d5db/fff&text=+" alt="{{ __('poster') }}">
        @endif
    </div>
    <div class="basis-3/5 min-w-[190px] sm:basis-3/4 ml-3 min-[500px]:ml-4 sm:ml-6 md:ml-9 md:ml-10 lg:ml-20">
        @if(!empty($movie['tagline_'.$locale]))
            <p class="pb-2 text-xs lg:text-sm text-light-text-secondary dark:text-dark-text-secondary italic">{{ $movie['tagline_'.$locale] }}</p>
        @elseif($locale === 'en' && $movie['tagline'])
            <p class="pb-2 text-xs lg:text-sm text-light-text-secondary dark:text-dark-text-secondary italic">{{ $movie['tagline'] }}</p>
        @endif
        @if(!empty($movie['overview_'.$locale]))
            <p class="text-xs sm:text-sm lg:text-base">{{ $movie['overview_'.$locale] }}</p>
        @else
            @if($locale !== 'en')
                <p class="text-xs text-light-text-secondary dark:text-dark-text-secondary">{{ '('.__('There is no overview available for this language').')' }}</p>
            @endif
            <p class="text-xs sm:text-sm lg:text-base">{{ $movie['overview'] }}</p>
        @endif

        @include('movies.partials.movie-details')
    </div>
</div>

<x-star-rating-panel
    class="md:hidden dark:bg-dark-element-secondary w-full max-w-[400px] sm:w-[350px] mx-auto mt-10 md:mt-16 pt-4 px-4 rounded border dark:border-gray-700 shadow-sm dark:text-light-text"
    movieId="{{ $movie->id }}"
    userRating="{{ $rating }}"
    :isFavourite="$isFavourite"
    :isWatchlistItem="$isWatchlistItem"
    :review="$review"
/>

@include('movies.partials.actors-carousel')

@include('movies.partials.review-carousel')
