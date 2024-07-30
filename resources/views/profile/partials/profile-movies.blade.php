<x-movies-carousel :models="$favourites" title="Favourites"
                   emptyMessage="No movies added to favourites yet."
                   class="sm:mb-10"/>

<hr class="mb-6 sm:mb-12 border-t border-gray-200 dark:border-gray-700">

<x-movies-carousel :models="$watchlist" title="Watchlist" emptyMessage="No movies added to watchlist yet."
                   class="sm:mb-10"/>

<hr class="mb-6 sm:mb-12 border-t border-gray-200 dark:border-gray-700">

<x-movies-carousel :models="$recentRatings" title="Recent Ratings" emptyMessage="No ratings yet."
                   class="sm:mb-10"/>

<hr class="mb-6 sm:mb-12 border-t border-gray-200 dark:border-gray-700">

<x-movies-carousel :models="$topRatings" title="Top Ratings" emptyMessage="No ratings yet."/>
