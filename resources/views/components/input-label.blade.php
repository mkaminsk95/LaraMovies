@props(['value'])

<label {{ $attributes->merge(['class' => 'block pt-3 text-sm text-black dark:text-gray-300 font-semibold leading-6']) }}>
    {{ $value ?? $slot }}
</label>
