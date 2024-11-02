<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\ActorsPopulatorInterface;
use Illuminate\Console\Command;

class PopulateDbWithActors extends Command
{
    protected $signature = 'app:populate-db-with-actors';

    protected $description = 'Command for populating the database with actors for existing movies.';

    public function __construct(
        private readonly ActorsPopulatorInterface $actorsPopulator
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        try {
            $this->actorsPopulator->populateActors();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        $this->info('Actors have been successfully populated.');
    }
}
