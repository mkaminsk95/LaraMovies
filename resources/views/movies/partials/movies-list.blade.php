@php
    $locale = app()->getLocale();
@endphp
<ul role="list" class="rounded">
    @if($paginatedMovies->isEmpty())
        <li class="flex relative mt-1 pl-7 p-4 gap-x-6 bg-light-element dark:bg-dark-element border border-1 border-gray-300 dark:border-gray-700 rounded">
            <div class="flex flex-col justify-between min-w-0">
                <div>
                    <p class="text-sm font-semibold leading-6">
                        {{ __('No movies found') }}
                    </p>
                </div>
            </div>
        </li>
    @endif
    @foreach($paginatedMovies as $movie)
        <li class="flex lg:w-[500px] relative mt-2.5 gap-x-6 bg-light-element dark:bg-dark-element shadow-md dark:shadow-shadow-color border border-1 border-gray-300 dark:border-gray-700 ">
            <div class="flex min-w-0 gap-x-4">
                @if($movie['poster_path'] !== null)
                    <img class="h-30 w-20 flex-none bg-gray-50"
                         src="https://image.tmdb.org/t/p/w185{{ $movie['poster_path'] }}"
                         alt="{{ __('poster') }}">
                @else
                    <img class="h-30 w-20 flex-none bg-gray-50"
                         src="https://dummyimage.com/185x278/d2d5db/fff&text=+" alt="{{ __('poster') }}">
                @endif
            </div>
            <div class="flex flex-row flex-1 justify-between shrink-0 my-3">
                <div class="flex flex-col justify-between min-w-0">
                    <div>
                        <p class="text-xs sm:text-sm font-semibold leading-6 hover:text-light-text-hover dark:hover:text-dark-text-hover">
                            <a href="{{ route('movies.show', $movie['id']) }}">
                                {{ $movie['title_'.$locale] ?? $movie['title'] }}
                            </a>
                        </p>
                        <p class="truncate text-xs leading-5 text-light-text-secondary dark:text-dark-text-secondary">{{ (new DateTime($movie['release_date']))->format('Y') }}</p>
                    </div>
                    <div>
                        @foreach($movie->genres as $genre)
                            <x-genre-block class="text-xs p-1 mr-1">{{ __($genre['name']) }}</x-genre-block>
                        @endforeach
                    </div>
                </div>
                <div class="mr-5 mt-2">
                    <x-star class="inline align-top leading-none text-star-gold" width="20px" height="20px"
                            :filled="true"/>
                    <span
                        class="inline-block align-top leading-5 text-sm">{{ number_format($movie->vote_average, 2, ',', '') }}</span>
                </div>
            </div>
            @if(auth()->user() && auth()->user()->is_admin)
                <div class="absolute -right-10 top-3">
                    <button form="delete-form-{{ $movie->id }}">
                        <svg class="w-6 h-6 text-light-text-secondary dark:text-dark-text-secondary" aria-hidden="true"
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
                        <svg class="w-6 h-6 text-light-text-secondary dark:text-dark-text-secondary"
                             viewBox="0 0 1024 1024"
                             x="128" y="128" role="img" xmlns="http://www.w3.org/2000/svg">
                            <g fill="currentColor">
                                <path fill="currentColor"
                                      d="M832 512a32 32 0 1 1 64 0v352a32 32 0 0 1-32 32H160a32 32 0 0 1-32-32V160a32 32 0 0 1 32-32h352a32 32 0 0 1 0 64H192v640h640V512z"/>
                                <path
                                    d="m469.952 554.24l52.8-7.552L847.104 222.4a32 32 0 1 0-45.248-45.248L477.44 501.44l-7.552 52.8zm422.4-422.4a96 96 0 0 1 0 135.808l-331.84 331.84a32 32 0 0 1-18.112 9.088L436.8 623.68a32 32 0 0 1-36.224-36.224l15.104-105.6a32 32 0 0 1 9.024-18.112l331.904-331.84a96 96 0 0 1 135.744 0z"/>
                            </g>
                        </svg>
                    </a>
                </div>
            @endif
        </li>
        <form id="delete-form-{{ $movie->id }}" method="POST" action="/movies/{{ $movie->id }}">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
</ul>
<div class="max-lg:hidden mt-4 mb-20 flex justify-center">
    {{ $paginatedMovies->onEachSide(1)->links() }}
</div>
<div class="lg:hidden mt-4 mb-20 flex justify-center">
    {{ $paginatedMovies->onEachSide(0)->links() }}
</div>
