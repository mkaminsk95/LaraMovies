<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Services\ActorsPopulatorInterface;
use Illuminate\Database\Seeder;

class MovieActorsSeeder extends Seeder
{
    public function __construct(
        private readonly ActorsPopulatorInterface $populator
    ) {
    }

    public function run(): void
    {
        $this->populator->populateActors();
    }
}
