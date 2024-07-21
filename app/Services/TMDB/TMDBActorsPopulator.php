<?php
declare(strict_types=1);

namespace App\Services\TMDB;

use Illuminate\Support\Facades\DB;
use App\Services\ActorsPopulatorInterface;
use App\Models\Credit;
use App\Models\Movie;
use App\Models\Person;

class TMDBActorsPopulator implements ActorsPopulatorInterface
{
    const ACTORS_FOR_MOVIE = 10;

    public function __construct(
        private readonly TMDBService $tmdbService
    ) {}

    public function populateActors(): void
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
            if ($casting['known_for_department'] !== Credit::DEPARTMENT_ACTING) {
                continue;
            }
            if ($actorsLeft === 0) {
                break;
            }

            $personData = $this->tmdbService->fetchPerson($casting['id']);

            if ($this->ifActorAlreadyExists($personData['id'])) {
                $person = $this->returnExistingActor($personData['id']);
            } else {
                $person = $this->addNewActor($personData);
            }

            $this->addNewCredit($movie, $person, $casting);
            $actorsLeft--;
        }
    }

    private function returnExistingActor(int $personId): Person
    {
        return Person::where('tmdb_id', $personId)->first();
    }

    private function ifActorAlreadyExists(int $personId): bool
    {
        return Person::where('tmdb_id', $personId)->exists();
    }

    private function addNewActor(array $personData): Person
    {
        $person = Person::create(
            [
                'tmdb_id' => $personData['id'],
                'name' => $personData['name'],
                'biography' => $personData['biography'],
                'birthday' => $personData['birthday'],
                'deathday' => $personData['deathday'],
                'popularity' => $personData['popularity'],
                'profile_path' => $personData['profile_path']
            ]
        );

        echo "Added new actor: " . $personData['name'] . "\n";
        return $person;
    }

    private function addNewCredit(Movie $movie, Person $person, array $credit): void
    {
        $credit = Credit::create(
            [
                'movie_id' => $movie->id,
                'person_id' => $person->id,
                'character' => $credit['character'],
                'department' => $credit['known_for_department']
            ]
        );
    }
}
