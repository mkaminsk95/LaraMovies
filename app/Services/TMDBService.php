<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class TMDBService implements MovieServiceInterface
{
    const API_URL = 'https://api.themoviedb.org/3/movie/top_rated';

    public function getMovies(int $n = 10): array
    {
        $apiKey = Config::get('services.themoviedb.api_key');

        $page = 1;
        $movies = [];
        while ($n > 0) {
            $result = Http::get($this::API_URL,
                [
                    'api_key' => $apiKey,
                    'page' => $page,
                ]
            )->json()['results'];

            if ($n > count($result)) {
                $movies = array_merge($result, $movies);
                $n -= count($result);
            } else {
                $movies = array_merge($result, array_slice($movies, 0, $n));
                $n = 0;
            }

            $page++;
        }

        return $movies;
    }
}
