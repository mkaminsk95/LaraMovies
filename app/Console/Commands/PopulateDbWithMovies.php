<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\MovieServiceInterface;
use Illuminate\Console\Command;
use App\Models\Movie;
use App\Services\TMDBService;

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


    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $number = $this->argument('number');

        if (!is_numeric($number)) {
            $this->error('The number must be an integer.');
            return;
        }

        $movies = $this->movieService->getMovies((int)$number);

        foreach ($movies as $movie) {
            try {
                Movie::create([
                    'tmdb_id' => $movie['id'],
                    'title' => $movie['title'],
                    'original_title' => $movie['original_title'],
                    'release_date' => $movie['release_date'],
                    'poster_path' => $movie['poster_path'],
                    'vote_average' => $movie['vote_average'],
                    'vote_count' => $movie['vote_count'],
                    'overview' => $movie['overview'],
                    'original_language' => $movie['original_language'],
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                continue;
            }
        }
    }
}
