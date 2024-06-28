@props(['label', 'id'])

@php
    $inputStyling = "block p-4 px-6 w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 font-medium focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:leading-6";
    $labelStyling = "block text-sm font-semibold leading-6";
@endphp

<label for="{{ $attributes->get('id') }}" class="{{ $labelStyling }}">
    {{ $label }}
</label>
<div class="mt-2">
    <input {{ $attributes->merge(['class' => $inputStyling, 'type' => 'text']) }}>
</div>
