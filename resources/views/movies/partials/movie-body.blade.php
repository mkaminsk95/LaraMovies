@php
    $locale = app()->getLocale();
@endphp
<div class="flex flex-row">
    <div class="w-[80px] min-[500px]:w-[110px] sm:w-[200px] sm:min-w-[80px] sm:max-w-[200px] md:max-w-full lg:basis-1/4">
        @if($movie['poster_path'] !== null)
            <img class="flex-none bg-gray-50 rounded"
                 src="https://image.tmdb.org/t/p/w780{{ $movie['poster_path'] }}"
                 alt="{{ __('poster') }}">
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
