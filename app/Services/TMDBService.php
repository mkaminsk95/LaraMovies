<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class TMDBService
{
    const API_URL = 'https://api.themoviedb.org/3/movie/top_rated';

    public function getTopRatedMovies(int $page = 1): array
    {
        $apiKey = Config::get('services.themoviedb.api_key');

        $response = Http::get($this::API_URL, [
            'api_key' => $apiKey,
            'page' => $page,
        ]);

        return ['movies' => $response->json()['results']];
    }
}
