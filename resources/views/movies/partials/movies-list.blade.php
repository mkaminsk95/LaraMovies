@php
    $locale = app()->getLocale();
@endphp
<ul role="list" class="rounded">
    @if($paginatedMovies->isEmpty())
        <div class="pt-12 min-w-[500px]">
            <p class="text-center text-lg font-semibold leading-6">
                {{ __('No movies found') }}
            </p>
        </div>
    @endif
    @foreach($paginatedMovies as $movie)
        <div class="even:bg-gray-200/50 dark:even:bg-dark-background/25">
            <div class="px-4 pt-4">
                @include('movies.partials.movie-item')
            </div>
            <hr class="mt-4 dark:border-gray-800"/>
            <form id="delete-form-{{ $movie->id }}" method="POST" action="/movies/{{ $movie->id }}">
                @csrf
                @method('DELETE')
            </form>
        </div>
    @endforeach
</ul>
<div class="max-lg:hidden mt-8 mb-20 flex justify-center">
    {{ $paginatedMovies->onEachSide(1)->links() }}
</div>
<div class="lg:hidden mt-8 mb-20 flex justify-center">
    {{ $paginatedMovies->onEachSide(0)->links() }}
</div>
