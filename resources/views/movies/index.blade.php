<x-layout>
    <div class="mt-12 mx-auto max-w-lg flex justify-center flex-col">
        <ul role="list" class="rounded">
            @foreach($paginatedMovies as $movie)
                <li class="flex relative mt-1 gap-x-6 bg-white dark:bg-gray-800 border border-1 border-gray-300 dark:border-gray-700 rounded">
                    <div class="flex min-w-0 gap-x-4">
                        @if($movie['poster_path'] !== null)
                            <img class="h-30 w-20 flex-none rounded bg-gray-50"
                                 src="https://image.tmdb.org/t/p/w185{{ $movie['poster_path'] }}"
                                 alt="">
                        @else
                            <img class="h-30 w-20 flex-none rounded bg-gray-50"
                                src="https://dummyimage.com/185x278/d2d5db/fff&text=+" alt="poster">
                        @endif
                    </div>
                    <div class="flex flex-row flex-1 justify-between shrink-0 my-3 rounded">
                        <div class="flex flex-col justify-between min-w-0">
                            <div>
                                <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-600">
                                <a class="hover:text-gray-500" href="{{ route('movies.show', $movie['id']) }}">
                                    {{ $movie['title'] }}
                                </a>
                            </p>
                                <p class="truncate text-xs leading-5 text-gray-500 dark:text-gray-700">{{ (new DateTime($movie['release_date']))->format('Y') }}</p>
                            </div>
                            <div>
                                @foreach($movie->genres as $genre)
                                    <span class="text-xs text-gray-500 p-1 mr-1 bg-gray-700 ">{{ $genre['name'] }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="mr-5 mt-2">
                            <svg class="inline align-top leading-none text-yellow-700" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" x="0" y="0" rx="30" fill="transparent" stroke="transparent" stroke-width="0" stroke-opacity="100%" paint-order="stroke"></rect><svg width="100" height="100" viewBox="0 0 1024 1024" fill="currentColor" x="0" y="0" role="img" style="display:inline-block;vertical-align:middle" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path fill="currentColor" d="m908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5c-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 0 0 .6 45.3l183.7 179.1l-43.4 252.9a31.95 31.95 0 0 0 46.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2c17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9l183.7-179.1c5-4.9 8.3-11.3 9.3-18.3c2.7-17.5-9.5-33.7-27-36.3z"/></g></svg></svg>
                            <span class="inline-block align-top leading-5 text-sm text-gray-900 dark:text-gray-400">{{ number_format($movie->vote_average, 2, ',', '') }}</span>
                        </div>
                    </div>
                    <div class="absolute -right-10 top-3">
                        <button form="delete-form-{{ $movie->id }}">
                            <svg class="w-6 h-6 text-red-800 dark:text-red-800" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                 viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                      d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                    <div class="absolute -right-10 top-10">
                        <a href={{ route('movies.edit', $movie->id) }}>
                            <svg class="w-6 h-6 text-gray-400 dark:text-gray-400"
                                 viewBox="0 0 1024 1024"
                                 x="128" y="128" role="img" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor" >
                                    <path fill="currentColor" d="M832 512a32 32 0 1 1 64 0v352a32 32 0 0 1-32 32H160a32 32 0 0 1-32-32V160a32 32 0 0 1 32-32h352a32 32 0 0 1 0 64H192v640h640V512z"/><path d="m469.952 554.24l52.8-7.552L847.104 222.4a32 32 0 1 0-45.248-45.248L477.44 501.44l-7.552 52.8zm422.4-422.4a96 96 0 0 1 0 135.808l-331.84 331.84a32 32 0 0 1-18.112 9.088L436.8 623.68a32 32 0 0 1-36.224-36.224l15.104-105.6a32 32 0 0 1 9.024-18.112l331.904-331.84a96 96 0 0 1 135.744 0z"/></g>
                            </svg>
                        </a>
                    </div>
                </li>
                <form id="delete-form-{{ $movie->id }}" method="POST" action="/movies/{{ $movie->id }}">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </ul>
        <div class="mt-4 mb-20 flex justify-center">
            {{ $paginatedMovies->onEachSide(1)->links() }}
        </div>
    </div>
</x-layout>
