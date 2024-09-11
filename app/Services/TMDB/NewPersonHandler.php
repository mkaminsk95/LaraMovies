<?php
declare(strict_types=1);

namespace App\Services\TMDB;

use App\Models\Credit;
use App\Models\Movie;
use App\Models\Person;

class NewPersonHandler
{
    public function __construct(
        private readonly TMDBService $tmdbService
    ) {}

    public function handle(Movie $movie, array $casting): void
    {
        $personData = $this->tmdbService->fetchPerson($casting['id']);

        if ($this->ifPersonAlreadyExists($personData['id'])) {
            $person = $this->returnExistingPerson($personData['id']);
        } else {
            $person = $this->addNewPerson($personData);
        }

        $this->addNewCredit($movie, $person, $casting);
    }

    private function returnExistingPerson(int $personId): Person
    {
        return Person::where('tmdb_id', $personId)->first();
    }

    private function ifPersonAlreadyExists(int $personId): bool
    {
        return Person::where('tmdb_id', $personId)->exists();
    }

    private function addNewPerson(array $personData): Person
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

        echo "Added new person: " . $personData['name'] . "\n";
        return $person;
    }

    private function addNewCredit(Movie $movie, Person $person, array $credit): void
    {
        Credit::create(
            [
                'movie_id' => $movie->id,
                'person_id' => $person->id,
                'character' => $credit['character'] ?? null,
                'department' => $credit['job'] ?? $credit['known_for_department'],
            ]
        );
        echo "Added new credit for department: " . ($credit['job'] ?? $credit['known_for_department']) . "\n";
    }
}
