@props(['label'])

<label for="{{ $attributes['id'] }}" class="block text-base font-semibold leading-6">
    {{ $label }}
</label>
<div class="mt-2">
    <select {{ $attributes }}
            class="block p-4 px-6 w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-input-placeholder font-medium focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:leading-6">
        <option value=""></option>
        @foreach($getMovieLanguages() as $language => $code)
            <option value="{{ $code }}" @selected($selected == $code)>
                {{ $language }}
            </option>
        @endforeach
    </select>
</div>
