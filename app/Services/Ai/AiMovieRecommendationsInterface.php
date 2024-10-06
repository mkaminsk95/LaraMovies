<?php

namespace App\Services\Ai;

use Illuminate\Support\Collection;

interface AiMovieRecommendationsInterface
{
    public function getRecommendations(array $data): Collection;
}
