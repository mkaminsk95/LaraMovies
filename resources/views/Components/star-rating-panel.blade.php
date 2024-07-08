@props(['movieId', 'userRating' => null, 'isFavourite' => false, 'isWatchlistItem' => false])
@php
    $rated = (bool)$userRating;
    $beforeRatingColor = 'bg-black';
    $afterRatingColor = 'bg-yellow-600';
@endphp

<div x-data="initializePanel()" x-on:mouseleave="clearRating()"
     class="absolute -bottom-4 right-9 h-32 pt-4 px-4 bg-gray-300 rounded">
    <div class="flex flex-row justify-between items-center">
        <div class="flex flex-row items-center gap-3">
            <span id="rating" class="flex ml-1 items-center justify-center w-10 h-10 {{ $rated ? $afterRatingColor : $beforeRatingColor }} text-white text-base rounded-full">
                <span x-text="ratingNum"></span>
                <x-spinner width="20" height="20"/>
            </span>
            <span x-text="ratingText" class="text-base tracking-wider"></span>
        </div>
        <div class="flex flex-row items-center gap-1 mt-1 mr-[1px]">
            <x-add-to-watchlist  width="26px" height="26px"  movieId="{{ $movieId }}" :added="$isWatchlistItem"/>
            <x-add-to-favourites width="26px" height="26px"  movieId="{{ $movieId }}" :added="$isFavourite"/>
        </div>
    </div>
    <div class="pt-3">
        @for($i = 0; $i < 10; $i++)
            <div class="inline-block" x-data="{starId: '{{$i+1}}', filled: 'nonzero'}"
                 x-on:mouseover="
                    if(!rated){
                        rating = starId;
                        ratingNum = rating;
                        ratingText = ratingNames[rating-1];
                 }"
                 x-on:click="submitData()">
                <x-star class="h-[26px] w-[26px]" filled="starId - 1 < rating ? 'nonzero' : 'evenodd'"></x-star>
            </div>
        @endfor
    </div>
</div>
<script>
    function initializePanel() {
        const ratingNames = [
            'Abysmal',
            'Terrible',
            'Awful',
            'Poor',
            'Mediocre',
            'Fair',
            'Good',
            'Very Good!',
            'Excellent!',
            'Perfect!'
        ];
        const rated = {{ $rated ? 'true' : 'false' }};
        const rating = '{{ $rated ?  $userRating : '' }}';
        const ratingNum = rating;
        const ratingText = ratingNames[rating - 1] ?? 'Your rating:';

        return {
            message: '',
            ratingNames: ratingNames,
            rating: rating,
            ratingNum: ratingNum,
            ratingText: ratingText,
            showSpinner: false,
            rated: rated,
            token: document.querySelector('meta[name="csrf-token"]').content,

            submitData() {
                if (!this.rated) {
                    this.showSpinner = true;
                    this.ratingNum = '';
                    this.rated = true;
                    fetch('/movies/{{$movieId}}/rate?rating=' + this.rating, {
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

                            this.showSpinner = false;
                            this.ratingNum = this.rating;

                            const ratingElement = document.getElementById('rating');
                            if (ratingElement.classList.contains) {
                                ratingElement.classList.remove("{{$beforeRatingColor}}");
                                ratingElement.classList.add("{{$afterRatingColor}}");
                            }
                        })
                        .catch(() => {
                            this.message = 'Something went wrong!'
                        })
                }
            },
            clearRating() {
                if (!this.rated) {
                    this.rating = '';
                    this.ratingNum = '';
                    this.ratingText = 'Your rating:';
                }
            },
        }
    }
</script>
