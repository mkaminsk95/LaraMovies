@props(['label', 'selected' => ''])

<div class="mt-2">
    <x-inputs.select {{ $attributes }} :options="$getMovieLanguages()" :value="$selected"/>
</div>
