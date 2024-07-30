@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block p-1 px-3 w-full rounded-md border-0 text-gray-800 text-sm placeholder:text-gray-400 font-medium focus:ring-2 focus:ring-indigo-600 sm:leading-6']) !!}>
