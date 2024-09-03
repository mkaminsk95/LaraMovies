<?php

namespace App\Providers;

use App\Services\ActorsPopulatorInterface;
use App\Services\MoviesPopulatorInterface;
use App\Services\TMDB\MovieTranslationsPopulatorInterface;
use App\Services\TMDB\TMDBActorsPopulator;
use App\Services\TMDB\TMDBMoviesPopulator;
use App\Services\TMDB\TMDBMovieTranslationsPopulator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MovieTranslationsPopulatorInterface::class, TMDBMovieTranslationsPopulator::class);
        $this->app->bind(MoviesPopulatorInterface::class, TMDBMoviesPopulator::class);
        $this->app->bind(ActorsPopulatorInterface::class, TMDBActorsPopulator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
