<?php

namespace App\Providers;

use App\Services\ActorsPopulatorInterface;
use App\Services\CrewPopulatorInterface;
use App\Services\MoviesPopulatorInterface;
use App\Services\TMDB\MovieTranslationsPopulatorInterface;
use App\Services\TMDB\TMDBActorsPopulator;
use App\Services\TMDB\TMDBCrewPopulator;
use App\Services\TMDB\TMDBMovieTranslationsPopulator;
use App\Services\TMDB\TMDBMoviesWithDetailsPopulator;
use Illuminate\Support\ServiceProvider;
use App\Services\Ai\AiMovieRecommendationsInterface;
use App\Services\Ai\Gemini\GeminiRecommendations;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MovieTranslationsPopulatorInterface::class, TMDBMovieTranslationsPopulator::class);
        $this->app->bind(MoviesPopulatorInterface::class, TMDBMoviesWithDetailsPopulator::class);
        $this->app->bind(ActorsPopulatorInterface::class, TMDBActorsPopulator::class);
        $this->app->bind(CrewPopulatorInterface::class, TMDBCrewPopulator::class);
        $this->app->bind(AiMovieRecommendationsInterface::class, GeminiRecommendations::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
