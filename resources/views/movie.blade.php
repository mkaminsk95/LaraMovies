<x-layout>
    <div class="flex flex-col mx-auto mt-10 w-1/2">
        <div class="relative">
            <img src="https://image.tmdb.org/t/p/original/{{ $movie['backdrop_path'] }}" alt="poster">
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
                <img class="flex-none rounded bg-gray-50"
                     src="https://image.tmdb.org/t/p/w1280/{{ $movie['poster_path'] }}"
                     alt="">
            </div>
            <div class="basis-1/2 ml-12">
                <p class="text-l mt-4">{{ $movie['overview'] }}</p>
            </div>
        </div>
    </div>
</x-layout>
