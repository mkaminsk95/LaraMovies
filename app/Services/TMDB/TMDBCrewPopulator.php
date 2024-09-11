<?php
declare(strict_types=1);

namespace App\Services\TMDB;

use App\Services\CrewPopulatorInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Credit;
use App\Models\Movie;

class TMDBCrewPopulator implements CrewPopulatorInterface
{
    private const int CREW_FOR_DEPARTMENT = 2;

    public function __construct(
        private readonly TMDBService $tmdbService,
        private readonly NewPersonHandler $newPersonHandler
    ) {}

    public function populateCrew(): void
    {
        DB::beginTransaction();

        $movies = Movie::all(['id', 'tmdb_id']);
        $moviesLeft = count($movies);

        try {
            foreach ($movies as $movie) {

                echo "Movies left: " . $moviesLeft . "\n";
                if (is_null($movie['tmdb_id'])) {
                    continue;
                }

                $this->populateCrewForMovie($movie);
                $moviesLeft--;
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function populateCrewForMovie(Movie $movie): void
    {
        $directorsLeft = self::CREW_FOR_DEPARTMENT;
        $writersLeft = self::CREW_FOR_DEPARTMENT;
        $crew = $this->tmdbService->fetchCrew($movie['tmdb_id']);

        foreach ($crew as $person) {
            if (!isset($person['job']) || !$this->ifPersonWorksInProduction($person['job'])) {
                continue;
            }

            if ($this->ifPersonIsDirector($person['job']) && $directorsLeft === 0) {
                continue;
            }
            if ($this->ifPersonIsWriter($person['job']) && $writersLeft === 0) {
                continue;
            }

            if ($this->ifThereIsEnoughCrewAdded($directorsLeft, $writersLeft)) {
                break;
            }

            $this->newPersonHandler->handle($movie, $person);

            if ($person['job'] === Credit::JOB_DIRECTOR) {
                $directorsLeft--;
            } else {
                $writersLeft--;
            }
        }
    }

    private function ifPersonWorksInProduction(string $job): bool
    {
        return $this->ifPersonIsDirector($job) || $this->ifPersonIsWriter($job);
    }

    private function ifPersonIsDirector(string $job): bool
    {
        return $job === Credit::JOB_DIRECTOR;
    }

    private function ifPersonIsWriter(string $job): bool
    {
        return $job === Credit::JOB_SCREENPLAY;
    }

    private function ifThereIsEnoughCrewAdded(int $directorsLeft, int $writersLeft): bool
    {
        return $directorsLeft === 0 && $writersLeft === 0;
    }
}
