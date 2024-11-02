<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\MoviesPopulatorInterface;
use Illuminate\Console\Command;

class PopulateDbWithMovies extends Command
{
    protected $signature = 'app:populate-db-with-movies {number : The number of movies to fetch}';

    protected $description = 'Command for populating the database with top rated movies from external source.';

    public function __construct(
        private readonly MoviesPopulatorInterface $moviesPopulator
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $number = $this->argument('number');

        if (! is_numeric($number)) {
            $this->error('The number must be an integer.');

            return;
        }

        try {
            $this->moviesPopulator->populateMovies((int) $number);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        $this->info('The database has been successfully populated with movies.');
    }
}
