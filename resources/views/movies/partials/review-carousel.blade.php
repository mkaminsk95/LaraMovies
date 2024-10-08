@if($movie->reviews()->count() > 0)
    @php
        if ($userReview = $movie->reviews->where('user_id', auth()->id())->first()) {
            $movie->reviews = $movie->reviews->filter(function ($value, $key) use ($userReview) {
                return $value != $userReview;
            });
            $movie->reviews->prepend($userReview);
        }
    @endphp
    <h2 class="max-md:text-center pt-8 sm:pt-12 text-xl sm:text-2xl font-medium tracking-wider uppercase">
        {{ __('Reviews') }}
    </h2>
    <x-carousel class="w-full mx-auto pt-4 sm:pt-8 pb-8" perViewExtraSmall='1' perViewSmall='1.6' perViewMedium='2'
                perViewLarge='2.2' arrowsPosition="top-[40%]">
        @foreach($movie->reviews as $index => $review)
            <li class="glide__slide">
                <div
                    class="ml-2 mb-10 p-4 min-h-[220px] relative bg-additional-element dark:text-black rounded shadow-lg shadow">
                    <div class="flex flex-row pt-2 items-center">
                        @if ($review->user['avatar_id'])
                            <img
                                class="w-14 h-14 rounded-full border-2 border-white dark:border-gray-800"
                                src="{{ Vite::asset('resources/assets/avatars/'.$review->user->avatar->path) }}"
                                alt="{{ __('profile') }}">
                        @else
                            <img class="w-14 h-14 rounded-full border-2 border-white dark:border-gray-800"
                                 src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                 alt="{{ __('profile') }}">
                        @endif
                        <a class="pl-4" href="{{ route('profile.show', $review->user->id) }}">
                            <span
                                class="text-lg hover:text-accent-primary transition duration-200 ease-in-out">{{ $review->user['name'] }}</span>
                        </a>
                    </div>

                    <p class="pt-3 text-sm sm:text-sm lg:text-md" lg:font-semibold >{{ $review['name'] }}</p>
                    <p id="review-{{$index}}"
                       class="pt-1 text-xs lg:text-sm line-clamp-10 break-words">{{ $review['description'] }}</p>
                    <button id="showmore-button-{{$index}}"
                            class="hidden text-sm text-accent-primary hover:text-accent-secondary transition duration-200 ease-in-out">

                    @if($review->rating?->rating)
                        <div class="absolute -top-[12px] right-2">
                            <div class="relative">
                                <span
                                    class="absolute inset-0 flex items-center justify-center text-lg text-star-gold-light">{{ $review->rating?->rating }}</span>
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
<script>
    const translations = {
        showMore: "{{ __('Show more') }}",
        showLess: "{{ __('Show less') }}"
    };

    const reviewElements = getReviewElements();
    addShowMoreButtonEvents()
    showShowMoreButtons();

    function getReviewElements() {
        const reviewElements = Array.from(document.querySelectorAll('[id^="review-"]'));
        const showMoreElements = Array.from(document.querySelectorAll('[id^="showmore-button-"]'));

        // Create an array to hold the pairs
        const pairedElements = [];

        let i = 0;
        while (reviewElements[i] && showMoreElements[i]) {
            pairedElements.push({
                "review-text": reviewElements[i],
                "showmore-button": showMoreElements[i]
            });
            i++;
        }

        return pairedElements;
    }

    function showShowMoreButtons() {
        reviewElements.forEach(element => {
            if (element["review-text"].scrollHeight > element["review-text"].clientHeight) {
                element['showmore-button'].classList.remove('hidden');
                element['showmore-button'].textContent = "{{ __('Show more') }}";
            }
        });
    }

    function addShowMoreButtonEvents() {
        reviewElements.forEach((element, index) => {
            element['showmore-button'].addEventListener('click', function() {
                let reviewElement = reviewElements[index]['review-text'],
                    showMoreButton = reviewElements[index]['showmore-button'];

                reviewElement.classList.toggle('line-clamp-2');
                showMoreButton.textContent = reviewElement.classList.contains('line-clamp-2') ? translations.showMore : translations.showLess;
            });
        })

    }

    function showResultMessage() {
        document.getElementById('result-message').classList.remove('hidden');
    }
</script>
