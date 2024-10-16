<?php
declare(strict_types=1);

namespace App\Services\TMDB;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class TMDBService
{
    private const string API_TOP_RATED_MOVIES_URL = 'https://api.themoviedb.org/3/movie/top_rated';
    private const string API_MOVIE_DETAILS_URL_TEMPLATE = 'https://api.themoviedb.org/3/movie/%s';
    private const string API_CREDITS_URL_TEMPLATE = 'https://api.themoviedb.org/3/movie/%s/credits';
    private const string API_PEOPLE_URL_TEMPLATE = 'https://api.themoviedb.org/3/person/%s';
    private const string API_GENRES_URL = 'https://api.themoviedb.org/3/genre/movie/list';
    private const string API_TRANSLATIONS_URL_TEMPLATE = 'https://api.themoviedb.org/3/movie/%s/translations';
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = (string)Config::get('services.themoviedb.api_key');
    }

    /**
     * @return array<mixed>
     */
    public function fetchTopRatedMovies(int $page): array
    {
        $response = Http::get(self::API_TOP_RATED_MOVIES_URL, [
            'api_key' => $this->apiKey,
            'page' => $page,
        ]);

        return $response->json()['results'] ?? [];
    }

    /**
     * @return array<mixed>
     */
    public function fetchMovieDetails(int $movieId): array
    {
        $response = Http::get($this->getMovieDetailsWithId($movieId), [
            'api_key' => $this->apiKey
        ]);

        return $response->json() ?? [];
    }

    /**
     * @return array<mixed>
     */
    public function fetchCredits(int $movieId): array
    {
        $response = Http::get($this->getCreditsUrlWithId($movieId), [
            'api_key' => $this->apiKey
        ]);

        return $response->json() ?? [];
    }

    /**
     * @return array<mixed>
     */
    public function fetchCastings(int $movieId): array
    {
        return $this->fetchCredits($movieId)['cast'] ?? [];
    }

    /**
     * @return array<mixed>
     */
    public function fetchCrew(int $movieId): array
    {
        return $this->fetchCredits($movieId)['crew'] ?? [];
    }

    /**
     * @return array<mixed>
     */
    public function fetchPerson(int $personId): array
    {
        $response = Http::get($this->getPeopleUrlWithId($personId), [
            'api_key' => $this->apiKey
        ]);

        return $response->json() ?? [];
    }

    /**
     * @return array<mixed>
     */
    public function fetchGenres(): array
    {
        $response = Http::get(self::API_GENRES_URL, [
            'api_key' => $this->apiKey
        ]);

        return $response->json()['genres'] ?? [];
    }

    /**
     * @param int $movieId
     * @return array<mixed>
     */
    public function fetchTranslations(int $movieId): array
    {
        $response = Http::get($this->getTranslationsUrlWithId($movieId), [
            'api_key' => $this->apiKey
        ]);

        return $response->json()['translations'] ?? [];
    }

    public function getMovieDetailsWithId(int $movieId): string {
        return sprintf(self::API_MOVIE_DETAILS_URL_TEMPLATE, $movieId);
    }

    public function getCreditsUrlWithId(int $movieId): string {
        return sprintf(self::API_CREDITS_URL_TEMPLATE, $movieId);
    }

    public function getPeopleUrlWithId(int $personId): string {
        return sprintf(self::API_PEOPLE_URL_TEMPLATE, $personId);
    }

    public function getTranslationsUrlWithId(int $movieId): string {
        return sprintf(self::API_TRANSLATIONS_URL_TEMPLATE, $movieId);
    }
}
