<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class TMDBService implements MovieServiceInterface
{
    const API_MOVIES_URL = 'https://api.themoviedb.org/3/movie/top_rated';
    const API_GENRES_URL = 'https://api.themoviedb.org/3/genre/movie/list';
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = (string)Config::get('services.themoviedb.api_key');
    }

    public function getMovies(int $n = 10): array
    {
        $page = 1;
        $movies = [];

        while ($n > 0) {
            $result = $this->fetchMovies($page);
            $movies = $this->mergeMovies($movies, $result, $n);

            $page++;
        }

        return $movies;
    }

    public function getGenres(): array
    {
        return $this->fetchGenres();
    }

    private function mergeMovies(array $movies, array $result, int &$n): array
    {
        $count = count($result);
        if ($n >= $count) {
            $movies = array_merge($movies, $result);
            $n -= count($result);
        } else {
            $movies = array_merge($movies, array_slice($result, 0, $n));
            $n = 0;
        }

        return $movies;
    }

    private function fetchMovies(int $page): array
    {
        $response = Http::get(self::API_MOVIES_URL, [
            'api_key' => $this->apiKey,
            'page' => $page,
        ]);

        return $response->json()['results'] ?? [];
    }

    private function fetchGenres(): array
    {
        $response = Http::get(self::API_GENRES_URL, [
            'api_key' => $this->apiKey
        ]);

        return $response->json()['genres'] ?? [];
    }
}
