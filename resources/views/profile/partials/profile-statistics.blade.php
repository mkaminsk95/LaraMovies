<div class="py-3 flex flex-row flex-wrap justify-center items-center gap-4 sm:gap-8 bg-gray-700 text-white text-base tracking-wider uppercase">
    <div class="flex flex-row items-center gap-1">
        <x-star class="h-[20px] w-[20px] sm:h-[28px] sm:w-[28px] md:h-[26px] md:w-[26px]"></x-star>
        Rated: {{ $topRatings->count() }}
    </div>
    <div class="flex flex-row items-center gap-1">
        <svg class="inline-block h-[20px] w-[20px] sm:h-[28px] sm:w-[28px] md:h-[26px] md:w-[26px]" viewBox="0 0 24 24"
             fill="currentColor" role="button"
             xmlns="http://www.w3.org/2000/svg">
            <g fill="currentColor">
                <path fill="rgb(255, 255, 255)"
                      d="M8.4 5.25c-2.78 0-5.15 2.08-5.15 4.78c0 1.863.872 3.431 2.028 4.73c1.153 1.295 2.64 2.382 3.983 3.292l2.319 1.57a.75.75 0 0 0 .84 0l2.319-1.57c1.344-.91 2.83-1.997 3.982-3.292c1.157-1.299 2.029-2.867 2.029-4.73c0-2.7-2.37-4.78-5.15-4.78c-1.434 0-2.695.672-3.6 1.542c-.905-.87-2.167-1.542-3.6-1.542Z"/>
            </g>
        </svg>
        Favourites: {{ $favourites->count() }}
    </div>
    <div class="flex flex-row items-center gap-1">
        <svg class="inline-block h-[20px] w-[20px] sm:h-[28px] sm:w-[28px] md:h-[26px] md:w-[26px]" viewBox="0 0 24 24"
             fill="currentColor" role="img"
             xmlns="http://www.w3.org/2000/svg">
            <g fill="currentColor">
                <path fill="rgb(255, 255, 255)" d="M12 9.75a2.25 2.25 0 1 0 0 4.5a2.25 2.25 0 0 0 0-4.5Z"/>
                <path fill="rgb(255, 255, 255)"
                      d="M12 5.5c-2.618 0-4.972 1.051-6.668 2.353c-.85.652-1.547 1.376-2.036 2.08c-.48.692-.796 1.418-.796 2.067c0 .649.317 1.375.796 2.066c.49.705 1.186 1.429 2.036 2.08C7.028 17.45 9.382 18.5 12 18.5c2.618 0 4.972-1.051 6.668-2.353c.85-.652 1.547-1.376 2.035-2.08c.48-.692.797-1.418.797-2.067c0-.649-.317-1.375-.797-2.066c-.488-.705-1.185-1.429-2.035-2.08C16.972 6.55 14.618 5.5 12 5.5ZM8.25 12a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0Z"
                      clip-rule="evenodd"/>
            </g>
        </svg>
        Watchlist: {{ $watchlist->count() }}
    </div>
</div>
