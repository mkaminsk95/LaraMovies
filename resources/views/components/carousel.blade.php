@props(['perViewExtraSmall' => 3, 'perViewSmall' => 4.7, 'perViewMedium' => 5.6, 'perViewLarge' => 6.4, 'arrowsPosition' => 'top-1/4'])
@vite('resources/js/carousel.js')
<div {{ $attributes }}>
    <div class="glide" data-carousel-settings='{"perViewExtraSmall": {{ $perViewExtraSmall }}, "perViewSmall": {{ $perViewSmall }}, "perViewMedium": {{ $perViewMedium }}, "perViewLarge": {{ $perViewLarge }}}'>
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                {{ $slot }}
            </ul>
        </div>
        <div class="leading-0 p-[2px] absolute {{ $arrowsPosition }} left-0 -translate-x-[20px] sm:-translate-x-[40px] md:-translate-x-[42px] md:-translate-x-[20px] border bg-gray-300/10 hover:bg-gray-200 dark:border-gray-500/40 rounded" data-glide-el="controls">
            <button data-glide-dir="<">
                <svg fill="#AAAAAA" class="w-[40px] h-[40px] md:w-[25px] md:h-[25px] lg:w-[30px] lg:h-[30px]" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path d="M30.83 32.67l-9.17-9.17 9.17-9.17-2.83-2.83-12 12 12 12z"/><path d="M0-.5h48v48h-48z" fill="none"/></svg>
            </button>
        </div>
        <div class="leading-0 p-[2px] absolute {{ $arrowsPosition }} right-0 translate-x-[20px] sm:translate-x-[30px] md:translate-x-[42px] md:translate-x-[20px] border bg-gray-300/10 hover:bg-gray-200 dark:border-gray-500/40 rounded shadow" data-glide-el="controls">
            <button data-glide-dir=">">
                <svg fill="#AAAAAA" class="w-[40px] h-[40px] md:w-[25px] md:h-[25px] lg:w-[30px] lg:h-[30px]" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path d="M17.17 32.92l9.17-9.17-9.17-9.17 2.83-2.83 12 12-12 12z"/><path d="M0-.25h48v48h-48z" fill="none"/></svg>
            </button>
        </div>
    </div>
</div>
