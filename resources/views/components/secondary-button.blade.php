<button {{ $attributes->merge(['type' => 'button', 'class' => 'ml-auto bg-black hover:bg-gray-800 w-28 h-8 text-xs text-white rounded tracking-widest uppercase transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
