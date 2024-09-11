<?php
declare(strict_types=1);

namespace App\Services\TMDB;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Services\MoviesPopulatorInterface;
use App\Services\DateFormatDeterminer;
use App\Models\Genre;
use App\Models\Movie;

class TMDBMoviesPopulator implements MoviesPopulatorInterface
{
    public function __construct(
        protected readonly TMDBService $tmdbService
    ) {}

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
            try {
                echo $movie['title'] . PHP_EOL;
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
                ])
                    ->genres()
                    ->attach($movie['genre_ids']);
            } catch (\Illuminate\Database\QueryException $e) {
                continue;
            }
        }
        DB::commit();
    }

    protected function provideMovies(int $number = 10): array
    {
        $page = 1;
        $movies = [];

        while ($number > 0) {
            $result = $this->tmdbService->fetchTopRatedMovies($page);
            if (empty($result)) {
                echo "No more movies to fetch\n";
                break;
            }

            $movies = $this->mergeMovies($movies, $result, $number);

            echo "Fetched page $page - $number movies left\n";
            $page++;
        }

        return $movies;
    }

    public function populateGenres(): void
    {
        $genres = $this->provideGenres();

        foreach ($genres as $genre) {
            try {
                Genre::create([
                    'id' => $genre['id'],
                    'name' => $genre['name'],
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                continue;
            }
        }
    }

    private function provideGenres(): array
    {
        return $this->tmdbService->fetchGenres();
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
}
