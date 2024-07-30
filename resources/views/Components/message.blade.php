@props(['type' => 'info', 'messages'])
@php
    $colors = match ($type) {
        'success' => ['background' => 'bg-green-100', 'border' => 'border-green-400', 'text' => 'text-green-700'],
        'info' => ['background' => 'bg-blue-100', 'border' => 'border-blue-400', 'text' => 'text-blue-700'],
        'warning' => ['background' => 'bg-yellow-100', 'border' => 'border-yellow-400', 'text' => 'text-yellow-700'],
        'error' => ['background' => 'bg-red-100', 'border' => 'border-red-400', 'text' => 'text-red-700'],
    };
@endphp

<div {{ $attributes->merge(['class' => implode(' ', $colors).' border px-4 py-3 rounded relative']) }}"
     role="alert">
    @if(is_array($messages) && count($messages) > 1)
        <ul class="list-disc list-inside text-sm {{ $colors['text'] }}">
            @foreach($messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @else
        <span class="text-sm text-{{ $colors['text'] }}-600">{{ is_array($messages) ? $messages[0] : $messages }}</span>
    @endif
</div>
