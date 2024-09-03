<?php

namespace Database\Seeders;

use App\Services\TMDB\MovieTranslationsPopulatorInterface;
use Illuminate\Database\Seeder;

class MovieTranslationsSeeder extends Seeder
{
    public function __construct(
        private readonly MovieTranslationsPopulatorInterface $populator
    ) {}

    public function run(): void
    {
        $this->populator->populate();
    }
}
