@props(['label', 'id'])

@php
    $inputStyling = "block p-1 px-3 w-full rounded-md border-0 text-gray-600 text-sm placeholder:text-gray-400 font-medium focus:ring-2 focus:ring-indigo-600 sm:leading-6";
    $labelStyling = "block pl-2 pt-6 text-xs font-semibold leading-6";
@endphp

<label for="{{ $attributes->get('id') }}" class="{{ $labelStyling }}">
    {{ $label }}
</label>
<div class="mt-1">
    <input {{ $attributes->merge(['class' => $inputStyling, 'type' => 'text']) }}>
</div>
