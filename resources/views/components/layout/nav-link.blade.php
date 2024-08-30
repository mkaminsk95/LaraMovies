@props(['active'])

@php
$classes = ($active ?? false)
            ? 'items-center px-1 border-b-2 border-indigo-400 dark:border-indigo-600 font-medium hover:text-light-text-hover dark:hover:text-dark-text-hover focus:outline-none focus:border-accent-primary transition duration-150 ease-in-out'
            : 'items-center px-1 border-b-2 border-transparent font-medium hover:text-light-text-hover dark:hover:text-dark-text-hover hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
