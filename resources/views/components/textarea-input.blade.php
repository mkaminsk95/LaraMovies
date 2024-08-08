@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-2.5 p-2 px-3 w-full rounded-md border-0 text-gray-800 text-sm placeholder:text-gray-400 font-medium shadow-sm ring-1 ring-gray-300 focus:ring-indigo-600 sm:leading-6']) !!}></textarea>
