<div class="relative">
    @if($movie['backdrop_path'] !== null)
        <img src="https://image.tmdb.org/t/p/w1280/{{ $movie['backdrop_path'] }}" alt="{{ __('poster') }}">
    @else
        <img src="https://dummyimage.com/1280x720/d2d5db/fff&text=+" alt="{{ __('poster') }}">
    @endif
    <div class="h-full w-full absolute -translate-y-full bg-gradient-to-t from-light-background dark:from-dark-background to-transparent ">
    </div>
    <div class="absolute bottom-4 sm:bottom-10 left-6 sm:left-8 max-w-[400px] lg:max-w-[600px]">
        <div class="mt-2 sm:mb-2">
            <x-star class="inline mr-1 align-top leading-none text-star-gold" width="26px" height="26px" :filled="true"/>
            <span class="inline-block align-top leading-7 text-md sm:text-lg lg:text-2xl">{{ number_format($movie->vote_average, 2, ',', '') }}</span>
        </div>
        <span class="text-lg md:text-2xl lg:text-3xl">{{ $movie['title_'.app()->getLocale()] ?? $movie['title'] }}</span>
        <span class="text-lg lg:text-2xl">({{ (new DateTime($movie['release_date']))->format('Y') }})</span>
        <div class="mt-1 sm:mt-3">
            @foreach($movie['genres'] as $genre)
                <x-genre-block class='text-xs sm:text-sm lg:text-md p-1 mr-3'>{{ __($genre['name']) }}</x-genre-block>
            @endforeach
        </div>

    </div>
    <x-star-rating-panel
        class="hidden md:block bg-additional-element absolute top-[302px] md:top-[318px] lg:top-[445px] right-9 md:w-[300px] lg:w-[330px] pt-4 px-4 rounded shadow-lg dark:text-black"
        movieId="{{ $movie->id }}"
        userRating="{{ $rating }}"
        :isFavourite="$isFavourite"
        :isWatchlistItem="$isWatchlistItem"
        :review="$review"
    />
</div>
