<?php

declare(strict_types=1);

namespace App\Services\TMDB;

use App\Models\Credit;
use App\Models\Movie;
use App\Services\ActorsPopulatorInterface;
use Illuminate\Support\Facades\DB;

class TMDBActorsPopulator implements ActorsPopulatorInterface
{
    const int ACTORS_FOR_MOVIE = 10;

    public function __construct(
        private readonly TMDBService $tmdbService,
        private readonly NewPersonHandler $newPersonHandler
    ) {
    }

    public function populateActors(): void
    {
        DB::beginTransaction();

        $movies = Movie::all(['id', 'tmdb_id']);
        $moviesLeft = count($movies);

        try {
            foreach ($movies as $movie) {

                echo 'Movies left: '.$moviesLeft."\n";
                if (is_null($movie['tmdb_id'])) {
                    continue;
                }

                $this->populateActorsForMovie($movie);
                $moviesLeft--;
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function populateActorsForMovie(Movie $movie): void
    {
        $actorsLeft = self::ACTORS_FOR_MOVIE;
        $castings = $this->tmdbService->fetchCastings($movie['tmdb_id']);

        foreach ($castings as $casting) {
            if (! $this->ifPersonIsActor($casting['known_for_department'])) {
                continue;
            }
            if ($actorsLeft === 0) {
                break;
            }

            $this->newPersonHandler->handle($movie, $casting);

            $actorsLeft--;
        }
    }

    private function ifPersonIsActor(string $department): bool
    {
        return $department === Credit::DEPARTMENT_ACTING;
    }
}
