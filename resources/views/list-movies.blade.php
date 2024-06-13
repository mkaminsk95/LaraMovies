<x-layout>
    <div class="mt-12 mx-12 flex justify-center">
        <ul role="list" class="divide-y-4 divide-gray-100 bg-white rounded">
            @foreach($movies as $movie)
                <li class="flex gap-x-6">
                    <div class="flex min-w-0 gap-x-4">
                        <img class="h-30 w-20 flex-none rounded bg-gray-50"
                             src="https://image.tmdb.org/t/p/w1280/{{ $movie['poster_path'] }}"
                             alt="">
                    </div>
                    <div class="flex flex-row flex-1 justify-between shrink-0 mt-3 rounded">
                        <span class="min-w-0">
                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $movie['title'] }}</p>
                            <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $movie['release_date']}}</p>
                        </span>
                        <span class="text-sm leading-6 text-gray-900 pr-5">Drama</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-layout>
