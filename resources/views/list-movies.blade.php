<x-layout>
    <div class="mt-12 mx-auto max-w-lg flex justify-center flex-col">
        <ul role="list" class="rounded">
            @foreach($paginatedMovies as $movie)
                <li class="flex mt-1 gap-x-6 bg-white dark:bg-gray-800 border border-1 border-gray-300 dark:border-gray-700 rounded">
                    <div class="flex min-w-0 gap-x-4">
                        <img class="h-30 w-20 flex-none rounded bg-gray-50"
                             src="https://image.tmdb.org/t/p/w1280/{{ $movie['poster_path'] }}"
                             alt="">
                    </div>
                    <div class="flex flex-row flex-1 justify-between shrink-0 mt-3 rounded">
                        <div class="min-w-0">
                            <span class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-600">
                                <a class="hover:text-gray-500" href="{{ route('movie', $movie['id']) }}">
                                    {{ $movie['title'] }}
                                </a>
                            </span>
                            <span class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-700">{{ $movie['release_date']}}</span>
                        </div>
                        <span class="text-sm leading-6 text-gray-900 dark:text-gray-600 pr-5">Drama</span>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4 mb-20 flex justify-center">
            {{ $paginatedMovies->onEachSide(1)->links() }}
        </div>
    </div>
</x-layout>
