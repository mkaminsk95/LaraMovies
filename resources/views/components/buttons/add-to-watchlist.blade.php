@props(['movieId', 'added' => false])

<span x-data="initializeAddToWatchlistButton" title="Add to watchlist"
      @click="runAnimation();addOrDeleteFromWatchlist()">
    <svg :width="animate ? '{{(int)$attributes['width']+4}}px' : '{{$attributes['width']}}'"
         :height="animate ? '{{(int)$attributes['width']+4}}px' : '{{$attributes['width']}}'"
         x-show="!added" class="transition-all duration-500 ease-in-out cursor-pointer"
         {{ $attributes }} viewBox="0 0 24 24" fill="currentColor" role="img"
         xmlns="http://www.w3.org/2000/svg">
        <g fill="currentColor">
            <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                <path
                    d="M8.25 12a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0ZM12 9.75a2.25 2.25 0 1 0 0 4.5a2.25 2.25 0 0 0 0-4.5Z"/>
                <path
                    d="M4.323 10.646c-.419.604-.573 1.077-.573 1.354c0 .277.154.75.573 1.354c.406.583 1.008 1.216 1.77 1.801C7.62 16.327 9.713 17.25 12 17.25s4.38-.923 5.907-2.095c.762-.585 1.364-1.218 1.77-1.801c.419-.604.573-1.077.573-1.354c0-.277-.154-.75-.573-1.354c-.406-.583-1.008-1.216-1.77-1.801C16.38 7.673 14.287 6.75 12 6.75s-4.38.923-5.907 2.095c-.762.585-1.364 1.218-1.77 1.801Zm.856-2.991C6.91 6.327 9.316 5.25 12 5.25s5.09 1.077 6.82 2.405c.867.665 1.583 1.407 2.089 2.136c.492.709.841 1.486.841 2.209c0 .723-.35 1.5-.841 2.209c-.506.729-1.222 1.47-2.088 2.136c-1.73 1.328-4.137 2.405-6.821 2.405s-5.09-1.077-6.82-2.405c-.867-.665-1.583-1.407-2.089-2.136C2.6 13.5 2.25 12.723 2.25 12c0-.723.35-1.5.841-2.209c.506-.729 1.222-1.47 2.088-2.136Z"/>
            </g>
        </g>
    </svg>
    <svg :width="animate ? '{{(int)$attributes['width']+4}}px' : '{{$attributes['width']}}'"
         :height="animate ? '{{(int)$attributes['width']+4}}px' : '{{$attributes['width']}}'"
         x-show="added" class="transition-all duration-500 ease-in-out cursor-pointer"
         {{ $attributes }} viewBox="0 0 24 24" fill="currentColor" role="img"
         xmlns="http://www.w3.org/2000/svg">
        <g fill="currentColor">
            <path fill="rgb(79 70 229)" d="M12 9.75a2.25 2.25 0 1 0 0 4.5a2.25 2.25 0 0 0 0-4.5Z"/>
            <path fill="rgb(79 70 229)" fill-rule="evenodd"
                  d="M12 5.5c-2.618 0-4.972 1.051-6.668 2.353c-.85.652-1.547 1.376-2.036 2.08c-.48.692-.796 1.418-.796 2.067c0 .649.317 1.375.796 2.066c.49.705 1.186 1.429 2.036 2.08C7.028 17.45 9.382 18.5 12 18.5c2.618 0 4.972-1.051 6.668-2.353c.85-.652 1.547-1.376 2.035-2.08c.48-.692.797-1.418.797-2.067c0-.649-.317-1.375-.797-2.066c-.488-.705-1.185-1.429-2.035-2.08C16.972 6.55 14.618 5.5 12 5.5ZM8.25 12a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0Z"
                  clip-rule="evenodd"/>
        </g>
    </svg>
</span>


<script>
    function initializeAddToWatchlistButton() {
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
            addOrDeleteFromWatchlist() {
                const method = this.added ? 'DELETE' : 'POST';
                fetch('/movies/{{$movieId}}/watchlist-items', {
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
