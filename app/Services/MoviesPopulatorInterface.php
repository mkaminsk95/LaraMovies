<?php

namespace App\Services;

interface MoviesPopulatorInterface
{
    public function populateMovies(int $number = 10): void;

    public function populateGenres(): void;
}
