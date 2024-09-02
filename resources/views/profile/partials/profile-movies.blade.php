<x-movies-carousel :models="$favourites" title=" {{ __('Favourites') }} "
                   emptyMessage="{{ __('No movies added to favourites yet.') }}"
                   class="sm:mb-10"/>

<hr class="mb-6 sm:mb-12 border-t border-gray-200 dark:border-gray-700">

<x-movies-carousel :models="$watchlist" title="{{ __('Watchlist') }}" emptyMessage="{{ __('No movies added to watchlist yet.') }}"
                   class="sm:mb-10"/>

<hr class="mb-6 sm:mb-12 border-t border-gray-200 dark:border-gray-700">

<x-movies-carousel :models="$recentRatings" title="{{ __('Recent Ratings') }}" emptyMessage="{{ __('No ratings yet.') }}"
                   class="sm:mb-10"/>

<hr class="mb-6 sm:mb-12 border-t border-gray-200 dark:border-gray-700">

<x-movies-carousel :models="$topRatings" title="{{ __('Top Ratings') }}" emptyMessage="{{ __('No ratings yet.') }}"/>
