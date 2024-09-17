<div x-show="togglePoster"
     x-transition.opacity.duration.400ms
     @click="togglePoster = false" class="fixed inset-0 bg-gray-500/75 z-50">
    <img @click.stop class="w-[400px] mx-auto mt-[120px] flex-none"
         src="https://image.tmdb.org/t/p/w780{{ $movie['poster_path'] }}"
         alt="{{ __('poster') }}">
</div>
