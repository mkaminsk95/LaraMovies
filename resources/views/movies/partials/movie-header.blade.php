<div class="relative">
    @if($movie['backdrop_path'] !== null)
        <img src="https://image.tmdb.org/t/p/w1280/{{ $movie['backdrop_path'] }}" alt="poster">
    @else
        <img src="https://dummyimage.com/1280x720/d2d5db/fff&text=+" alt="poster">
    @endif
    <div class="h-full w-full absolute -translate-y-full text-white bg-gradient-to-t from-gray-900 to-transparent ">
    </div>
    <div class="absolute bottom-10 left-8 max-w-[400px] lg:max-w-[600px] text-white">
        <div class="mt-2 mb-2">
            <x-star class="inline mr-1 align-top leading-none text-star-gold" width="30px" height="30px" :filled="true"/>
            <span class="inline-block align-top leading-7 text-lg lg:text-2xl text-white dark:text-white">{{ number_format($movie->vote_average, 2, ',', '') }}</span>
        </div>
        <span class="text-2xl md:text-3xl lg:text-4xl">{{ $movie['title'] }}</span>
        <span class="text-lg lg:text-2xl">({{ (new DateTime($movie['release_date']))->format('Y') }})</span>
        <div class="mt-3">
            @foreach($movie['genres'] as $genre)
                <x-genre-block class='text-sm lg:text-md p-1 mr-3 bg-gray-800'>{{ $genre['name'] }}</x-genre-block>
            @endforeach
        </div>

    </div>
    <x-star-rating-panel
        class="hidden md:block absolute top-[302px] lg:top-[412px] right-9 md:w-[300px] lg:w-[330px] pt-4 px-4 bg-gray-300 rounded"
        movieId="{{ $movie->id }}"
        userRating="{{ $rating }}"
        :isFavourite="$isFavourite"
        :isWatchlistItem="$isWatchlistItem"
        :review="$review"
    />
</div>
