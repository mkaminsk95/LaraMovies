@props(['disabled' => false, 'options' => [], 'value' => ''])

<select
    type="select" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-2.5 p-2 px-3 w-full rounded-md border-0 text-gray-800 text-sm shadow-lg shadow-shadow-color placeholder:text-gray-400 font-medium ring-1 ring-gray-300 focus:ring-1 focus:ring-indigo-600 sm:leading-6']) !!}>
    <option value=""></option>
    @foreach($options as $key => $option)
        <option value="{{ strtolower($key) }}" {{ $key == $value ? 'selected' : '' }}>{{ $option }}</option>
    @endforeach
</select>
