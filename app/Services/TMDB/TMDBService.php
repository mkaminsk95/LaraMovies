<?php
declare(strict_types=1);

namespace App\Services\TMDB;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class TMDBService
{
    const API_TOP_RATED_MOVIES_URL = 'https://api.themoviedb.org/3/movie/top_rated';
    private const API_CREDITS_URL_TEMPLATE = 'https://api.themoviedb.org/3/movie/%s/credits';
    private const API_PEOPLE_URL_TEMPLATE = 'https://api.themoviedb.org/3/person/%s';
    const API_GENRES_URL = 'https://api.themoviedb.org/3/genre/movie/list';
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = (string)Config::get('services.themoviedb.api_key');
    }

    public function fetchTopRatedMovies(int $page): array
    {
        $response = Http::get(self::API_TOP_RATED_MOVIES_URL, [
            'api_key' => $this->apiKey,
            'page' => $page,
        ]);

        return $response->json()['results'] ?? [];
    }

    public function fetchCastings(int $movieId): array
    {
        $response = Http::get($this->getCreditsUrlWithId($movieId), [
            'api_key' => $this->apiKey
        ]);

        return $response->json()['cast'] ?? [];
    }

    public function fetchPerson(int $personId): array
    {
        $response = Http::get($this->getPeopleUrlWithId($personId), [
            'api_key' => $this->apiKey
        ]);

        return $response->json() ?? [];
    }

    public function fetchGenres(): array
    {
        $response = Http::get(self::API_GENRES_URL, [
            'api_key' => $this->apiKey
        ]);

        return $response->json()['genres'] ?? [];
    }

    public function getCreditsUrlWithId(int $movieId): string {
        return sprintf(self::API_CREDITS_URL_TEMPLATE, $movieId);
    }

    public function getPeopleUrlWithId(int $personId): string {
        return sprintf(self::API_PEOPLE_URL_TEMPLATE, $personId);
    }
}
