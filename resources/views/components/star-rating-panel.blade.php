@props(['movieId', 'userRating' => null, 'isFavourite' => false, 'isWatchlistItem' => false, 'review' => null])
@php
    $rated = (bool)$userRating;
    $beforeRatingColor = 'bg-black';
    $afterRatingColor = 'bg-star-gold';
@endphp

<div x-on:mouseleave="clearRating()" @resize.window="starSize = getStarSize()"
    {{ $attributes->merge(['class' => 'rating-panel py-5 px-4 rounded']) }}>
    <div class="flex flex-row justify-between items-center">
        <div class="flex flex-row items-center gap-3">
            <span id="rating"
                  class="flex ml-1 items-center justify-center w-10 h-10 {{ $rated ? $afterRatingColor : $beforeRatingColor }} text-white text-base rounded-full">
                <span x-text="ratingNum"></span>
                <x-spinner width="20" height="20"/>
            </span>
            <span x-text="ratingText" class="text-base tracking-wider"></span>
        </div>
        <div class="flex flex-row items-center gap-1 mt-1 mr-[1px]">
            <x-buttons.add-to-watchlist width="26px" height="26px" movieId="{{ $movieId }}" :added="$isWatchlistItem"/>
            <x-buttons.add-to-favourites width="26px" height="26px" movieId="{{ $movieId }}" :added="$isFavourite"/>
        </div>
    </div>
    <div class="flex flex-row md:pt-3 pt-4" x-on:mouseleave="bringBackRating()">
        @for($i = 0; $i < 10; $i++)
            <div x-data="{starId: '{{$i+1}}', filled: 'nonzero'}"
                 x-on:mouseover="displayRatingProposition()"
                 x-on:click="submitData()" class="cursor-pointer">
                <x-star x-bind:height="starSize" x-bind:width="starSize"
                        filled="starId - 1 < ratingNum ? 'nonzero' : 'evenodd'"></x-star>
            </div>
        @endfor
    </div>
    <div x-data="{showReviewForm: false}">
        <div class="pt-5">
            @auth
                <div class="flex">
                    <x-buttons.secondary x-on:click="showReviewForm = !showReviewForm"
                                         x-show="!showReviewForm">{{ $review ? __('Edit review') : __('Review') }}</x-buttons.secondary>
                </div>
            @endauth
            @guest
                <p class="pr-3 text-right text-xs text-light-text-secondary hover:text-light-text-hover italic"><a
                        href="{{ route('login') }}"><strong>{{ __('Login') }}</strong> {{ __('to leave a review') }}</a>
                </p>
            @endguest
        </div>
        <form x-show="showReviewForm" action="{{ route('review.create', $movieId) }}" method="post">
            @csrf
            <div class="float-right pb-2 pr-1 cursor-pointer">
                <svg @click="showReviewForm = false" height="24" width="24" viewBox="0 0 48 48"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M38 12.83l-2.83-2.83-11.17 11.17-11.17-11.17-2.83 2.83 11.17 11.17-11.17 11.17 2.83 2.83 11.17-11.17 11.17 11.17 2.83-2.83-11.17-11.17z"/>
                    <path d="M0 0h48v48h-48z" fill="none"/>
                </svg>
            </div>
            <x-inputs.text name="name" placeholder="{{ __('Title') }}" value="{{ $review?->name }}" required/>
            <x-inputs.textarea name="description" class="resize-none mt-3" placeholder="{{ __('Write a review...') }}"
                               rows="3"
                               maxlength="200" required
                               value="{{ $review?->description }}"/>
            <div class="flex">
                <x-buttons.primary class="mt-3">{{ __('Submit') }}</x-buttons.primary>
            </div>
        </form>
    </div>
</div>
<script>
    function initializePanel() {
        const getStarSize = function () {
            let element = document.getElementsByClassName('rating-panel')[0];
            if (element.clientWidth === 0) {
                element = document.getElementsByClassName('rating-panel')[1];
            }
            let widthWithPaddings = element.clientWidth;
            const elementComputedStyle = window.getComputedStyle(element, null);
            return (
                widthWithPaddings -
                parseFloat(elementComputedStyle.paddingLeft) -
                parseFloat(elementComputedStyle.paddingRight)
            ) / 10;
        }

        const ratingNames = [
            '{{ __('Abysmal') }}',
            '{{ __('Terrible') }}',
            '{{ __('Awful') }}',
            '{{ __('Poor') }}',
            '{{ __('Mediocre') }}',
            '{{ __('Fair') }}',
            '{{ __('Good') }}',
            '{{ __('Very Good!') }}',
            '{{ __('Excellent!') }}',
            '{{ __('Perfect!') }}'
        ];

        const rated = {{ $rated ? 'true' : 'false' }};
        const rating = '{{ $rated ?  $userRating : '' }}';
        const ratingNum = rating;
        const ratingText = ratingNames[rating - 1] ?? '{{ __('Your rating:') }}';

        const starSize = getStarSize();

        return {
            message: '',
            ratingNames: ratingNames,
            rating: rating,
            ratingNum: ratingNum,
            ratingNew: null,
            ratingText: ratingText,
            showSpinner: false,
            rated: rated,
            token: document.querySelector('meta[name="csrf-token"]').content,
            starSize: starSize,

            submitData() {
                this.showSpinner = true;
                this.ratingNum = '';

                if (this.rating === this.ratingNew) {
                    this.deleteRating();
                    return;
                }

                this.postRating();
            },

            postRating() {
                let url = '/movies/{{$movieId}}/rate?rating=' + this.ratingNew;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.token
                    },
                })
                    .then((response) => {
                        if (response.redirected) {
                            window.location.href = response.url;
                            return;
                        }
                        this.rated = true;
                        this.showSpinner = false;
                        this.rating = this.ratingNew;
                        this.ratingNum = this.ratingNew;
                        this.ratingText = this.ratingNames[this.ratingNew - 1];

                        const ratingElement = document.getElementById('rating');
                        if (ratingElement.classList.contains) {
                            ratingElement.classList.remove("{{$beforeRatingColor}}");
                            ratingElement.classList.add("{{$afterRatingColor}}");
                        }
                    })
                    .catch(() => {
                        this.message = '{{ __('Something went wrong!') }}'
                    })
            },

            deleteRating() {
                let url = '/movies/{{$movieId}}/rate';

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.token
                    },
                })
                    .then((response) => {
                        this.rated = false;
                        this.showSpinner = false;
                        this.rating = '';
                        this.ratingNum = '';
                        this.ratingText = '{{ __('Your rating:') }}';

                        const ratingElement = document.getElementById('rating');
                        if (ratingElement.classList.contains) {
                            ratingElement.classList.remove("{{$afterRatingColor}}");
                            ratingElement.classList.add("{{$beforeRatingColor}}");
                        }
                    })
                    .catch(() => {
                        this.message = '{{ __('Something went wrong!') }}'
                    })
            },

            clearRating() {
                if (!this.rated) {
                    this.rating = '';
                    this.ratingNum = '';
                    this.ratingText = '{{ __('Your rating:') }}';
                }
            },
            displayRatingProposition() {
                if (this.showSpinner) {
                    return;
                }
                let ratingProposition = this.starId;
                this.ratingNum = ratingProposition;
                this.ratingNew = ratingProposition;
                this.ratingText = this.ratingNames[ratingProposition - 1];
            },
            bringBackRating() {
                if (this.rated) {
                    this.ratingNum = this.rating;
                    this.ratingText = this.ratingNames[this.rating - 1];
                }
            },

            getStarSize: getStarSize,
        }
    }
</script>
