@props(['label', 'selected' => ''])

<div class="mt-2">
    <x-select-input {{ $attributes }} :options="$getMovieLanguages()" :value="$selected"/>
</div>
