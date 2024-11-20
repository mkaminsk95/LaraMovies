<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Services\MoviesPopulatorInterface;
use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    public function __construct(
        private readonly MoviesPopulatorInterface $populator
    ) {
    }

    public function run(): void
    {
        $this->populator->populateMovies(1000);
    }
}
