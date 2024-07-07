@props(['value'])

<label {{ $attributes->merge(['class' => 'block pl-2 pt-6 text-xs text-gray-300 font-semibold leading-6']) }}>
    {{ $value ?? $slot }}
</label>
