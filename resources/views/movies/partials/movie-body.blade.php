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
    class="md:hidden h-32 w-3/4 max-w-[350px] sm:w-[350px] mx-auto mt-8 sm:mt-12"
    movieId="{{ $movie->id }}"
    userRating="{{ $rating }}"
    :isFavourite="$isFavourite"
    :isWatchlistItem="$isWatchlistItem"
/>

@if($movie->credits->count())
    <h2 class="md:pl-[80px] max-md:text-center pt-8 sm:pt-12 md:pt-10 dark:text-gray-300 text-2xl font-medium tracking-wider">Top Billed Cast</h2>
    <x-carousel class="w-full mx-auto pb-8">
        @foreach($movie->credits as $credit)
            @if($credit->person['profile_path'] !== null)
                <li class="glide__slide">
                    <img class="carousel-image border dark:border-gray-700" src="https://image.tmdb.org/t/p/w185{{ $credit->person['profile_path'] }}" alt="">
                    <p class="pt-5 text-center text-sm lg:text-base dark:text-gray-400">{{ $credit['character'] }}</p>
                    <p class="pt-2 text-center text-xs lg:text-sm text-gray-600">{{ $credit->person['name'] }}</p>
                </li>
            @endif
        @endforeach
    </x-carousel>
@endif
