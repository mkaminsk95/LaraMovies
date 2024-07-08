<x-layout>
    <div class="flex flex-col mx-auto mt-10 w-[1000px]">
        <div class="relative">
            @if($movie['backdrop_path'] !== null)
                <img src="https://image.tmdb.org/t/p/w1280/{{ $movie['backdrop_path'] }}" alt="poster">
            @else
                <img src="https://dummyimage.com/1280x720/d2d5db/fff&text=+" alt="poster">
            @endif
            <div class="h-full w-full absolute -translate-y-full text-white bg-gradient-to-t from-gray-900 to-transparent ">
            </div>
            <div class="absolute bottom-10 left-8 max-w-[600px] text-white">
                <div class="mt-2 mb-2">
                    <x-star class="inline mr-1 align-top leading-none text-yellow-600" width="30px" height="30px" :filled="true"/>
                    <span class="inline-block align-top leading-7 text-2xl text-white dark:text-white">{{ number_format($movie->vote_average, 2, ',', '') }}</span>
                </div>
                <span class="text-4xl">{{ $movie['title'] }}</span>
                <span class="text-2xl">({{ (new DateTime($movie['release_date']))->format('Y') }})</span>
                <div class="mt-3">
                    @foreach($movie['genres'] as $genre)
                        <x-genre-block class='text-l p-1 mr-3 bg-gray-800'>{{ $genre['name'] }}</x-genre-block>
                    @endforeach
                </div>

            </div>
            <x-star-rating-panel
                movieId="{{ $movie->id }}"
                userRating="{{ $rating }}"
                :isFavourite="$isFavourite"
                :isWatchlistItem="$isWatchlistItem"
            />
        </div>
        <div class="flex flex-row px-8 py-8 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-400">
            <div class="basis-1/4">
                @if($movie['poster_path'] !== null)
                    <img class="flex-none rounded bg-gray-50"
                         src="https://image.tmdb.org/t/p/w780{{ $movie['poster_path'] }}"
                         alt="">
                @else
                    <img src="https://dummyimage.com/780x1170/d2d5db/fff&text=+" alt="poster">
                @endif
            </div>
            <div class="basis-1/2 ml-12">
                <p class="text-l mt-4">{{ $movie['overview'] }}</p>
            </div>
        </div>
    </div>
</x-layout>
