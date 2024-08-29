@if($movie->credits->count())
    <h2 class="max-md:text-center pt-12 sm:pt-12 md:pt-20 text-2xl font-medium tracking-wider uppercase">Cast</h2>
    <x-carousel class="w-full mx-auto pt-8">
        @foreach($movie->credits as $credit)
            @if($credit->person['profile_path'] !== null)
                <li class="glide__slide">
                    <img class="carousel-image border dark:border-gray-700"
                         src="https://image.tmdb.org/t/p/w185{{ $credit->person['profile_path'] }}" alt="">
                    <p class="pt-5 text-center text-sm lg:text-base">{{ $credit['character'] }}</p>
                    <p class="pt-2 text-center text-xs lg:text-sm text-light-text-secondary dark:text-dark-text-secondary">{{ $credit->person['name'] }}</p>
                </li>
            @endif
        @endforeach
    </x-carousel>
@endif
