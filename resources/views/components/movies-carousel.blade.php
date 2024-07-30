@props(['movies' => null, 'models' => null, 'title', 'emptyMessage'])
@php
    if (is_null($movies) && !is_null($models)) {
        $movies = $models->map(
            function($model) {
                return $model->movie;
            });
    };
@endphp

<section {{ $attributes }}>
    <h2 class="sm:pl-14 dark:text-gray-300 text-center sm:text-left text-xl font-normal tracking-wide uppercase">{{ $title }}</h2>
    @if($movies->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-300">{{ $emptyMessage }}</p>
    @else
        <x-carousel class="mx-auto px-6 sm:px-14  sm:pb-8" perViewExtraSmall="3" perViewSmall="4.4" perViewMedium="5.4"
                    perViewLarge="7.4">
            @foreach($movies as $movie)
                <li class="glide__slide">
                    <a href="{{ route('movies.show', $movie->id) }}">
                        <img class="carousel-image shadow-lg rounded-lg"
                             src="https://image.tmdb.org/t/p/w154{{ $movie->poster_path }}"
                             alt="poster">
                        <p class="pt-5 text-center text-sm lg:text-sm dark:text-gray-500 hover:text-gray-300">{{ $movie->title }}</p>
                    </a>
                </li>
            @endforeach
        </x-carousel>
    @endif
</section>
