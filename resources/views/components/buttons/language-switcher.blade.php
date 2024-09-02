@props(['btnClass' => '', 'flagSize' => '16'])
@php
    $flagsSvgs = [
        'en' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$flagSize.'" height="'.$flagSize.'" viewBox="0 0 32 32"><rect x="1" y="4" width="30" height="24" rx="4" ry="4" fill="#071b65"></rect><path d="M5.101,4h-.101c-1.981,0-3.615,1.444-3.933,3.334L26.899,28h.101c1.981,0,3.615-1.444,3.933-3.334L5.101,4Z" fill="#fff"></path><path d="M22.25,19h-2.5l9.934,7.947c.387-.353,.704-.777,.929-1.257l-8.363-6.691Z" fill="#b92932"></path><path d="M1.387,6.309l8.363,6.691h2.5L2.316,5.053c-.387,.353-.704,.777-.929,1.257Z" fill="#b92932"></path><path d="M5,28h.101L30.933,7.334c-.318-1.891-1.952-3.334-3.933-3.334h-.101L1.067,24.666c.318,1.891,1.952,3.334,3.933,3.334Z" fill="#fff"></path><rect x="13" y="4" width="6" height="24" fill="#fff"></rect><rect x="1" y="13" width="30" height="6" fill="#fff"></rect><rect x="14" y="4" width="4" height="24" fill="#b92932"></rect><rect x="14" y="1" width="4" height="30" transform="translate(32) rotate(90)" fill="#b92932"></rect><path d="M28.222,4.21l-9.222,7.376v1.414h.75l9.943-7.94c-.419-.384-.918-.671-1.471-.85Z" fill="#b92932"></path><path d="M2.328,26.957c.414,.374,.904,.656,1.447,.832l9.225-7.38v-1.408h-.75L2.328,26.957Z" fill="#b92932"></path><path d="M27,4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4Zm3,20c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24Z" opacity=".15"></path><path d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z" fill="#fff" opacity=".2"></path></svg>',
        'pl' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$flagSize.'" height="'.$flagSize.'" viewBox="0 0 32 32"><path d="M1,24c0,2.209,1.791,4,4,4H27c2.209,0,4-1.791,4-4V15H1v9Z" fill="#cb2e40"></path><path d="M27,4H5c-2.209,0-4,1.791-4,4v8H31V8c0-2.209-1.791-4-4-4Z" fill="#fff"></path><path d="M5,28H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4ZM2,8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8Z" opacity=".15"></path><path d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z" fill="#fff" opacity=".2"></path></svg>'
    ];
    if (request()->session()->has('locale') && array_key_exists(request()->session()->get('locale'), $flagsSvgs)) {
        $selectedFlag = $flagsSvgs[request()->session()->get('locale')];
    } else {
        $selectedFlag = $flagsSvgs['en'];
    }
@endphp
<div x-data="{switcher:translationSwitcher()}" {{ $attributes }}>
    <div class="">
        <div class="w-full flex justify-end">
            <div class="relative" @click.away="switcher.menuToggle=false">
                <button
                    class="{{ $btnClass }} flex flex-row items-center rounded bg-light-element dark:bg-dark-element py-1 px-1 gap-2 focus:outline-none"
                    @click.prevent="switcher.menuToggle=!switcher.menuToggle">
                    <span>{!! $selectedFlag !!}</span>
                    <svg fill="currentColor" height="12px" width="12px" viewBox="0 0 512 512" xml:space="preserve"
                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon
                            points="396.6,160 416,180.7 256,352 96,180.7 115.3,160 256,310.5 "/></svg>
                </button>
                <div
                    class="bg-white text-gray-700 shadow-md rounded text-sm absolute mt-12 top-0 right-0 min-w-full w-32 z-30"
                    x-show="switcher.menuToggle" x-transition:enter="transition ease duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-4">
                    <span class="absolute top-0 right-0 w-3 h-3 bg-white transform rotate-45 -mt-1 mr-3"></span>
                    <div class="bg-white overflow-auto rounded w-full relative z-10">
                        <ul>
                            <li>
                                <a href="{{ url('language') }}/en"
                                   class="px-4 py-2 flex flex-row items-center no-underline hover:no-underline transition-colors duration-100"
                                   @click="switcher.menuToggle=false;switcher.selected=index;">
                                    <span>
                                        {!! $flagsSvgs['en'] !!}
                                    </span>
                                    <span class="inline-block pl-2">{{ __('English') }}</span>
                                    <template x-if="index==switcher.selected">
                                        <span class="ml-auto">
                                            <i class="mdi mdi-check"></i>
                                        </span>
                                    </template>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('language') }}/pl"
                                   class="px-4 py-2 flex flex-row items-center no-underline hover:no-underline transition-colors duration-100"
                                   @click="switcher.menuToggle=false;switcher.selected=index;">
                                    <span>
                                        {!! $flagsSvgs['pl'] !!}
                                    </span>
                                    <span class="inline-block pl-2">{{ __('Polish') }}</span>
                                    <template x-if="index==switcher.selected">
                                        <span class="ml-auto">
                                            <i class="mdi mdi-check"></i>
                                        </span>
                                    </template>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let translationSwitcher = function () {
        const locale = '{{ request()->session()->get('locale') }}';
        const countries = [
            {
                label: '{{ __('English') }}',
                lang: 'en',
                flag: 'gb',
                flagSvg: '',
            },
            {
                label: '{{ __('Polish') }}',
                lang: 'pl',
                flag: 'pl',
                flagSvg: '<svg xmlns="http://www.w3.org/2000/svg" width="{{$flagSize}}" height="{{$flagSize}}" viewBox="0 0 32 32"><path d="M1,24c0,2.209,1.791,4,4,4H27c2.209,0,4-1.791,4-4V15H1v9Z" fill="#cb2e40"></path><path d="M27,4H5c-2.209,0-4,1.791-4,4v8H31V8c0-2.209-1.791-4-4-4Z" fill="#fff"></path><path d="M5,28H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4ZM2,8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8Z" opacity=".15"></path><path d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z" fill="#fff" opacity=".2"></path></svg>',
            },
        ];

        let selected = 0;
        if (locale) {
            countries.forEach((country, index) => {
                if (country.lang === locale) {
                    selected = index;
                }
            });
        }

        return {
            selected: selected,
            countries: countries,
            menuToggle: false,
        }
    }
</script>
