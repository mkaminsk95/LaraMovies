<?php

namespace App\Services\Ai;

use App\Models\Movie;
use Illuminate\Support\Collection;

interface AiMovieRecommendationsInterface
{
    /**
     * @param  array<mixed>  $data
     * @return Collection<int, Movie>
     */
    public function getRecommendations(array $data): Collection;
}
