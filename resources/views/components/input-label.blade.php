@props(['value'])

<label {{ $attributes->merge(['class' => 'block pt-3 text-sm font-semibold leading-6']) }}>
    {{ $value ?? $slot }}
</label>
