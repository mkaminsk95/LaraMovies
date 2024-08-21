@if($movie->reviews())
    @php
        if ($userReview = $movie->reviews->where('user_id', auth()->id())->first()) {
            $movie->reviews = $movie->reviews->filter(function ($value, $key) use ($userReview) {
                return $value != $userReview;
            });
            $movie->reviews->prepend($userReview);
        }
    @endphp
    <h2 class="max-md:text-center pt-8 sm:pt-12 md:pt-12 dark:text-gray-300 text-2xl font-medium tracking-wider uppercase">
        Reviews</h2>
    <x-carousel class="w-full mx-auto pt-8 pb-8" perViewExtraSmall='1' perViewSmall='1.6' perViewMedium='2'
                perViewLarge='2.5' arrowsPosition="top-[40%]">
        @foreach($movie->reviews as $review)
            <li class="glide__slide">
                <div class="p-4 overflow-y-scroll h-[250px] relative bg-gray-300 rounded">
                    <div class="flex flex-row pt-2 items-center">
                        @if ($review->user['avatar_id'])
                            <img
                                class="w-14 h-14 rounded-full border-2 border-white dark:border-gray-800"
                                src="{{ Vite::asset('resources/assets/avatars/'.$review->user->avatar->path) }}"
                                alt="profile">
                        @else
                            <img class="w-14 h-14 rounded-full border-2 border-white dark:border-gray-800"
                                 src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                 alt="profile">
                        @endif
                        <a class="pl-4" href="{{ route('profile.show', $review->user->id) }}">
                            <span class="text-lg hover:text-primary transition duration-200 ease-in-out">{{ $review->user['name'] }}</span>
                        </a>
                    </div>

                    <p class="pt-3 text-md sm:text-sm lg:text-lg">{{ $review['name'] }}</p>
                    <p class="pt-2 text-sm sm:text-xs lg:text-sm break-words">{{ $review['description'] }}</p>

                    @if($review->rating?->rating)
                        <div class="absolute -top-[12px] right-2">
                            <div class="relative">
                                <span class="absolute inset-0 flex items-center justify-center text-lg text-star-gold-light">{{ $review->rating?->rating }}</span>
                                <svg height="65" width="65" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M34 6H14c-2.21 0-3.98 1.79-3.98 4L10 42l14-6 14 6V10c0-2.21-1.79-4-4-4z"/>
                                    <path d="M0 0h48v48H0z" fill="none"/>
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>
            </li>
        @endforeach
    </x-carousel>
@endif
