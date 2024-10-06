@props(['disabled' => false, 'options' => [], 'value' => '', 'displayEmptyOption' => true])

<select
    type="select" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-2.5 p-2 px-3 w-full rounded-md border-0 text-black text-sm shadow-lg shadow-shadow-color placeholder:text-input-placeholder font-medium ring-1 ring-gray-300 focus:ring-1 focus:ring-indigo-600 sm:leading-6']) !!}>
    @if($displayEmptyOption)
        <option value=""></option>
    @endif
    @foreach($options as $key => $option)
        <option value="{{ strtolower($key) }}" @selected($key == $value)>{{ $option }}</option>
    @endforeach
</select>
