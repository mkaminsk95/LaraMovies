<button {{ $attributes->merge(['type' => 'submit', 'class' => 'ml-auto bg-accent-primary hover:bg-indigo-500 w-28 h-8 text-xs text-white rounded tracking-widest uppercase transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
