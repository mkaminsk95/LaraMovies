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
                    <svg class="inline mr-1 align-top leading-none text-yellow-700" width="30px" height="30px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" x="0" y="0" rx="30" fill="transparent" stroke="transparent" stroke-width="0" stroke-opacity="100%" paint-order="stroke"></rect><svg width="100" height="100" viewBox="0 0 1024 1024" fill="currentColor" x="0" y="0" role="img" style="display:inline-block;vertical-align:middle" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path fill="currentColor" d="m908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5c-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 0 0 .6 45.3l183.7 179.1l-43.4 252.9a31.95 31.95 0 0 0 46.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2c17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9l183.7-179.1c5-4.9 8.3-11.3 9.3-18.3c2.7-17.5-9.5-33.7-27-36.3z"/></g></svg></svg>
                    <span class="inline-block align-top leading-7 text-2xl text-white dark:text-white">{{ number_format($movie->vote_average, 2, ',', '') }}</span>
                </div>
                <span class="text-4xl">{{ $movie['title'] }}</span>
                <span class="text-2xl">({{ (new DateTime($movie['release_date']))->format('Y') }})</span>
                <div class="mt-3">
                    @foreach($movie['genres'] as $genre)
                        <span class="text-l p-1 mr-3 bg-gray-800 ">{{ $genre['name'] }}</span>
                    @endforeach
                </div>

            </div>
            <div class="absolute -bottom-4 right-9 h-32 pt-4 px-4 bg-gray-300 rounded">
                <div class="flex flex-row items-center gap-3">
                    <span class="flex ml-1 items-center justify-center w-10 h-10 bg-black text-white text-base rounded-full">8</span>
                    <span class="text-base tracking-wider">Awesome!</span>
                </div>
                <div class="pt-3">
                    @for($i = 0; $i < 10; $i++)
                        <svg class="inline" width="26px" height="26px" viewBox="0 0 100 100" style="color:currentColor" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" x="0" y="0" rx="30" fill="transparent" stroke="transparent" stroke-width="0" stroke-opacity="100%" paint-order="stroke"></rect><svg width="100" height="100" viewBox="0 0 48 48" fill="currentColor" x="0" y="0" role="img" style="display:inline-block;vertical-align:middle" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path fill="currentColor" fill-rule="evenodd" d="m24 9.762l-3.89 7.92a3.007 3.007 0 0 1-2.265 1.65l-8.717 1.273l6.314 6.185a3.015 3.015 0 0 1 .862 2.66l-1.489 8.722l7.782-4.111a3.003 3.003 0 0 1 2.806 0l7.782 4.11l-1.489-8.72a3.015 3.015 0 0 1 .862-2.661l6.315-6.185l-8.718-1.273a3.007 3.007 0 0 1-2.265-1.65L24 9.761Zm.903-2.698a1.005 1.005 0 0 0-1.806 0L18.315 16.8c-.147.298-.43.505-.759.553L6.864 18.914c-.826.121-1.156 1.141-.558 1.726l7.738 7.579c.237.232.346.567.29.895l-1.827 10.7c-.141.827.722 1.458 1.461 1.068l9.564-5.053c.294-.155.644-.155.938 0l9.564 5.053c.739.39 1.602-.24 1.461-1.067l-1.827-10.7a1.015 1.015 0 0 1 .29-.896l7.738-7.579c.597-.585.268-1.605-.558-1.726l-10.694-1.56a1.008 1.008 0 0 1-.758-.554l-4.782-9.736Z" clip-rule="evenodd"/></g></svg></svg>
                    @endfor
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
