<x-layout>
    <div class="flex flex-col mx-auto pb-12 md:mt-12 lg:mt-10 w-full md:w-[725px] lg:w-[1000px] bg-white dark:bg-gray-800">
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
                    <span class="inline-block align-top leading-7 text-lg lg:text-2xl text-white dark:text-white">{{ number_format($movie->vote_average, 2, ',', '') }}</span>
                </div>
                <span class="text-3xl lg:text-4xl">{{ $movie['title'] }}</span>
                <span class="text-lg lg:text-2xl">({{ (new DateTime($movie['release_date']))->format('Y') }})</span>
                <div class="mt-3">
                    @foreach($movie['genres'] as $genre)
                        <x-genre-block class='text-sm lg:text-md p-1 mr-3 bg-gray-800'>{{ $genre['name'] }}</x-genre-block>
                    @endforeach
                </div>

            </div>
            <x-star-rating-panel
                class="hidden md:block absolute -bottom-4 right-9 h-32 pt-4 px-4"
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
                <p class="text-sm lg:text-base mt-4">{{ $movie['overview'] }}</p>
            </div>
        </div>
        <x-star-rating-panel
            class="md:hidden h-32 w-[350px] mx-auto mt-8 pt-6 px-4 bg-gray-300 rounded"
            movieId="{{ $movie->id }}"
            userRating="{{ $rating }}"
            :isFavourite="$isFavourite"
            :isWatchlistItem="$isWatchlistItem"
        />

        @if($movie->credits->count())
            <h2 class="pl-[110px] md:pl-[80px] pt-16 md:pt-4 dark:text-gray-300 text-xl md:text-2xl font-medium tracking-wider">Top Billed Cast</h2>
            <x-carousel class="w-11/12 md:w-[725px] lg:w-[1000px] mx-auto px-14 pb-8">
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

    </div>
</x-layout>
