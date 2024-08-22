<div class="flex flex-row bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-400">
    <div class="sm:basis-1/4 lg:basis-1/4 min-w-[80px] max-w-[120px] sm:max-w-[200px] md:max-w-full">
        @if($movie['poster_path'] !== null)
            <img class="flex-none bg-gray-50"
                 src="https://image.tmdb.org/t/p/w780{{ $movie['poster_path'] }}"
                 alt="">
        @else
            <img src="https://dummyimage.com/780x1170/d2d5db/fff&text=+" alt="poster">
        @endif
    </div>
    <div class="basis-auto sm:basis-3/4 lg:basis-3/4 ml-7 sm:ml-9 md:ml-10 lg:ml-20">
        <p class="text-xs sm:text-sm lg:text-base">{{ $movie['overview'] }}</p>
    </div>
</div>

<x-star-rating-panel
    class="md:hidden w-full max-w-[400px] sm:w-[350px] mx-auto mt-16 pt-4 px-4 bg-gray-300 rounded"
    movieId="{{ $movie->id }}"
    userRating="{{ $rating }}"
    :isFavourite="$isFavourite"
    :isWatchlistItem="$isWatchlistItem"
    :review="$review"
/>

@include('movies.partials.actors-carousel')

@include('movies.partials.review-carousel')
