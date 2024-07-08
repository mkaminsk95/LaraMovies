@props(['movieId', 'added' => false])

<span x-data="initializeAddToFavouritesButton"
      @click="runAnimation();addOrDeleteFromFavourites()">
    <svg :width="animate ? '{{(int)$attributes['width']+4}}px' : '{{$attributes['width']}}'"
         :height="animate ? '{{(int)$attributes['width']+4}}px' : '{{$attributes['width']}}'"
         x-show="!added" class="transition-all duration-500 ease-in-out cursor-pointer"
         {{ $attributes }} viewBox="0 0 24 24" fill="currentColor" role="button"
         xmlns="http://www.w3.org/2000/svg">
        <g fill="currentColor">
            <path fill="currentColor" fill-rule="evenodd"
                  d="M3.25 10.03c0-2.7 2.37-4.78 5.15-4.78c1.433 0 2.695.672 3.6 1.542c.905-.87 2.166-1.542 3.6-1.542c2.78 0 5.15 2.08 5.15 4.78c0 1.85-.789 3.476-1.882 4.852c-1.09 1.372-2.518 2.537-3.884 3.484c-.523.362-1.05.695-1.534.941c-.454.231-.975.443-1.45.443s-.996-.212-1.45-.443a13.795 13.795 0 0 1-1.533-.941c-1.367-.947-2.794-2.112-3.885-3.484C4.039 13.506 3.25 11.88 3.25 10.03ZM8.4 6.75c-2.08 0-3.65 1.53-3.65 3.28c0 1.403.596 2.71 1.556 3.918c.962 1.21 2.257 2.279 3.565 3.185c.495.343.96.634 1.36.838c.428.218.676.279.769.279c.093 0 .341-.061.77-.28a12.35 12.35 0 0 0 1.36-.837c1.307-.906 2.602-1.974 3.564-3.185c.96-1.208 1.556-2.515 1.556-3.918c0-1.75-1.57-3.28-3.65-3.28c-1.194 0-2.31.713-3.005 1.619a.75.75 0 0 1-1.19 0C10.71 7.463 9.595 6.75 8.4 6.75Z"
                  clip-rule="evenodd"/>
        </g>
    </svg>
    <svg :width= "animate ? '{{(int)$attributes['width']+4}}px' : '{{$attributes['width']}}'"
         :height="animate ? '{{(int)$attributes['width']+4}}px' : '{{$attributes['width']}}'"
         x-show="added" class="transition-all duration-500 ease-in-out cursor-pointer"
         {{ $attributes }} viewBox="0 0 24 24" fill="currentColor" role="button"
         xmlns="http://www.w3.org/2000/svg">
        <g fill="red">
            <path fill="rgb(179, 0, 0)"
                  d="M8.4 5.25c-2.78 0-5.15 2.08-5.15 4.78c0 1.863.872 3.431 2.028 4.73c1.153 1.295 2.64 2.382 3.983 3.292l2.319 1.57a.75.75 0 0 0 .84 0l2.319-1.57c1.344-.91 2.83-1.997 3.982-3.292c1.157-1.299 2.029-2.867 2.029-4.73c0-2.7-2.37-4.78-5.15-4.78c-1.434 0-2.695.672-3.6 1.542c-.905-.87-2.167-1.542-3.6-1.542Z"/>
        </g>
    </svg>
</span>

<script>
    function initializeAddToFavouritesButton() {
        return {
            added: {{ $added ? "true" : "false" }},
            token: document.querySelector('meta[name="csrf-token"]').content,
            animate: false,

            runAnimation() {
                this.animate = true;
                setTimeout(() => {
                    this.added = !this.added;
                    setTimeout(() => {
                        this.animate = false;
                    }, 100);
                }, 500);
            },
            addOrDeleteFromFavourites() {
                const method = this.added ? 'DELETE' : 'POST';
                fetch('/movies/{{$movieId}}/favourites', {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.token
                    },
                })
                    .then((response) => {
                        if (response.redirected) {
                            window.location.href = response.url;
                        }
                    })
            }
        }
    }
</script>
