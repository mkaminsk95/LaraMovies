@vite(['resources/js/carousel.js'])
<div {{ $attributes }}>
    <div class="glide mt-5">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                {{ $slot }}
            </ul>
        </div>
        <div class="absolute start-0 top-1/2 -translate-y-[60px] -translate-x-[70px] bg-gray-300 hover:bg-gray-200 border dark:border-gray-500 rounded" data-glide-el="controls">
            <button data-glide-dir="<">
                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="currentColor" role="img" style="display:inline-block;vertical-align:middle" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path fill="currentColor" d="M16 6a1 1 0 0 0-1.6-.8l-8 6a1 1 0 0 0 0 1.6l8 6A1 1 0 0 0 16 18V6Z"/></g></svg>
            </button>
        </div>
        <div class="absolute end-0 top-1/2 -translate-y-[60px] translate-x-[70px] bg-gray-300 hover:bg-gray-200 border dark:border-gray-500 rounded" data-glide-el="controls">
            <button data-glide-dir=">">
                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="currentColor" role="img" style="display:inline-block;vertical-align:middle" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path fill="currentColor" d="M8 6a1 1 0 0 1 1.6-.8l8 6a1 1 0 0 1 0 1.6l-8 6A1 1 0 0 1 8 18V6Z"/></g></svg>
            </button>
        </div>
    </div>
</div>
