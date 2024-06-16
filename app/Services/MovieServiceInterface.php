<?php

namespace App\Services;

interface MovieServiceInterface
{
    public function getMovies(int $n = 10): array;
    public function getGenres(): array;
}
