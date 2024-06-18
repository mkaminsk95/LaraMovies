<x-layout>
    <div class="flex flex-col mx-auto mt-10 w-1/2">
        <div class="relative">
            @if($movie['backdrop_path'] !== null)
                <img src="https://image.tmdb.org/t/p/w1280/{{ $movie['backdrop_path'] }}" alt="poster">
            @else
                <img src="https://dummyimage.com/1280x720/d2d5db/fff&text=+" alt="poster">
            @endif
            <div class="h-full w-full absolute -translate-y-full text-white bg-gradient-to-t from-gray-900 to-transparent ">
            </div>
            <div class=" relative left-16 -translate-y-full text-white">
                <span class="text-4xl">{{ $movie['title'] }}</span>
                <span class="text-2xl">({{ (new DateTime($movie['release_date']))->format('Y') }})</span>
                <div class="mt-3">
                    @foreach($movie['genres'] as $genre)
                        <span class="text-l p-1 mr-3 bg-gray-800 ">{{ $genre['name'] }}</span>
                    @endforeach
                </div>
            </div>
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
