<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\MovieServiceInterface;
use App\Models\Genre;
use App\Models\Movie;
use App\Services\DateFormatDeterminer;


class PopulateDbWithMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-db-with-movies {number : The number of movies to fetch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for populating the database with top rated movies from external source.';

    public function __construct(
        private readonly MovieServiceInterface $movieService
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $number = $this->argument('number');

        if (!is_numeric($number)) {
            $this->error('The number must be an integer.');
            return;
        }

        DB::beginTransaction();
        $this->populateGenres();
        $this->populateMovies((int)$number);
        DB::commit();
    }

    public function populateGenres(): void
    {
        $genres = $this->movieService->getGenres();

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

    public function populateMovies(int $number): void
    {
        $movies = $this->movieService->getMovies($number);
        $format = DateFormatDeterminer::determine($movies[0]['release_date']);

        if ($format === false) {
            $this->error('The date format is not supported.');
            DB::rollback();
            return;
        }

        foreach ($movies as $movie) {
            try {
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
    }
}
