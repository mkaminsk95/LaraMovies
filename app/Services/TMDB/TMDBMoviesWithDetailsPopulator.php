<?php
declare(strict_types=1);

namespace App\Services\TMDB;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\DateFormatDeterminer;

class TMDBMoviesWithDetailsPopulator extends TMDBMoviesPopulator
{
    public function __construct(
        TMDBService $tmdbService
    ) {
        parent::__construct($tmdbService);
    }

    public function populateMovies(int $number = 10): void
    {
        DB::beginTransaction();
        $this->populateGenres();

        $movies = $this->provideMovies($number);
        $format = DateFormatDeterminer::determine($movies[0]['release_date']);

        if ($format === false) {
            DB::rollback();
            throw new \Exception('The date format is not supported.');
        }

        foreach ($movies as $movie) {
            $additionalDetails = $this->provideAdditionalDetails($movie['id']);

            try {
                echo $movie['title'] . PHP_EOL;
                if ($this->ifMovieExists($movie['id'])) {
                    $this->updateMovie($movie, $additionalDetails, $format);
                } else {
                    $this->createMovie($movie, $additionalDetails, $format);
                }
            } catch (\Illuminate\Database\QueryException $e) {
                continue;
            }
        }
        DB::commit();
    }

    private function ifMovieExists($tmdbId): bool
    {
        return Movie::where('tmdb_id', $tmdbId)->exists();
    }

    private function updateMovie(array $movie, array $additionalDetails, string $format)
    {
        Movie::where('tmdb_id', $movie['id'])->update([
            'budget' => $additionalDetails['budget'] ?? null,
            'revenue' => $additionalDetails['revenue'] ?? null,
            'runtime' => $additionalDetails['runtime'] ?? null,
            'status' => $additionalDetails['status'] ?? null,
            'adult' => $additionalDetails['adult'] ?? null,
            'origin_country' => json_encode($additionalDetails['origin_country'] ?? null),
        ]);
    }

    private function createMovie(array $movie, array $additionalDetails, string $format): void
    {
        Movie::create([
            'tmdb_id' => $movie['id'],
            'title' => $movie['title'],
            'original_title' => $movie['original_title'],
            'release_date' => Carbon::createFromFormat($format, $movie['release_date']),
            'poster_path' => $movie['poster_path'],
            'backdrop_path' => $movie['backdrop_path'],
            'vote_average' => $movie['vote_average'],
            'vote_count' => $movie['vote_count'],
            'overview' => $movie['overview'],
            'original_language' => $movie['original_language'],
            'budget' => $additionalDetails['budget'] ?? null,
            'revenue' => $additionalDetails['revenue'] ?? null,
            'runtime' => $additionalDetails['runtime'] ?? null,
            'status' => $additionalDetails['status'] ?? null,
            'adult' => $additionalDetails['adult'] ?? null,
            'origin_country' => json_encode($additionalDetails['origin_country'] ?? null),
        ])
            ->genres()
            ->attach($movie['genre_ids']);
    }

    private function provideAdditionalDetails(int $tmdbId): array
    {
        return $this->tmdbService->fetchMovieDetails($tmdbId);
    }
}
