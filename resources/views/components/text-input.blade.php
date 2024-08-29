@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-2.5 p-2 px-3 w-full rounded-md border-0 text-black text-sm placeholder:text-input-placeholder font-medium shadow-lg shadow-shadow-color ring-1 ring-gray-300 focus:ring-indigo-600 sm:leading-6']) !!}>
