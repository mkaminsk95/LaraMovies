@props(['perViewExtraSmall' => 3, 'perViewSmall' => 4.7, 'perViewMedium' => 5.6, 'perViewLarge' => 8.4])
@vite('resources/js/carousel.js')
<div {{ $attributes }} x-data="window.initializeCarousel()" @glidemounted.window="topValue = calculateHeight()" @resize.window="topValue = calculateHeight()">
    <div class="glide mt-5" data-carousel-settings='{"perViewExtraSmall": {{ $perViewExtraSmall }}, "perViewSmall": {{ $perViewSmall }}, "perViewMedium": {{ $perViewMedium }}, "perViewLarge": {{ $perViewLarge }}}'>
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                {{ $slot }}
            </ul>
        </div>
        <div class="leading-0 p-[2px] absolute start-0 -translate-x-[24px] sm:-translate-x-[30px] md:-translate-x-[50px] md:-translate-x-[20px] border bg-gray-300/80 hover:bg-gray-200 dark:border-gray-500 rounded-full" data-glide-el="controls"
             :style="{top: topValue}">
            <button data-glide-dir="<">
                <svg class="w-[40px] h-[40px] md:w-[25px] md:h-[25px] lg:w-[30px] lg:h-[30px]" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path d="M30.83 32.67l-9.17-9.17 9.17-9.17-2.83-2.83-12 12 12 12z"/><path d="M0-.5h48v48h-48z" fill="none"/></svg>
            </button>
        </div>
        <div class="leading-0 p-[2px] absolute end-0 translate-x-[24px] sm:translate-x-[30px] md:translate-x-[50px] md:translate-x-[20px] border bg-gray-300/80 hover:bg-gray-200 dark:border-gray-500 rounded-full shadow" data-glide-el="controls"
             :style="{top: topValue}">
            <button data-glide-dir=">">
                <svg class="w-[40px] h-[40px] md:w-[25px] md:h-[25px] lg:w-[30px] lg:h-[30px]" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path d="M17.17 32.92l9.17-9.17-9.17-9.17 2.83-2.83 12 12-12 12z"/><path d="M0-.25h48v48h-48z" fill="none"/></svg>
            </button>
        </div>
    </div>
</div>
<script>
    initializeCarousel = function () {
        const calculateHeight = function () {
            return (document.getElementsByClassName('carousel-image')[0].height - 20) / 2 + 'px';
        }

        return {
            calculateHeight: calculateHeight,
            topValue: calculateHeight(),
        }
    }
</script>
