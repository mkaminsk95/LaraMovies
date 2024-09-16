<x-layout.base>
    <div class="h-fit relative">
        <div id="loader" class="absolute bg-gray-400/25 inset-0 z-20">
            <div class="fixed top-1/2 left-1/2">
                <svg class="animate-spin" fill="none" height="48" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M4 24C4 35.0457 12.9543 44 24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/></svg>
            </div>
        </div>
        {{ $slot }}
    </div>
</x-layout.base>
