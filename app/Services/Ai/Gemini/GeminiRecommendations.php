<?php

declare(strict_types=1);

namespace App\Services\Ai\Gemini;

use App\Models\Movie;
use App\Models\Rating;
use App\Services\Ai\AiMovieRecommendationsInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Throwable;

class GeminiRecommendations implements AiMovieRecommendationsInterface
{
    const int NUMBER_OF_RECOMMENDATIONS = 4;

    public function __construct(
        private readonly GeminiService $geminiService
    ) {
    }

    /**
     * @param  array<mixed>  $data
     * @return Collection<int, Movie>
     *
     * @throws Throwable
     */
    public function getRecommendations(array $data): Collection
    {
        $genre = $data['genre'] ?? 'Any';
        $note = $data['note'] ?? '';

        if (auth()->check()) {
            $topRatings = $this->getUserTopRating();

            $response = $this->geminiService->fetchRecommendationsForLogged($topRatings, $genre, $note);
        } else {
            $response = $this->geminiService->fetchRecommendationsForGuest($genre, $note);
        }

        $response = $this->formatResponse($response);
        $movies = $this->correlateMovies($response);
        $this->getRidOfDuplications($movies);

        return $this->limitNumberOfMovies($movies);
    }

    /**
     * @return Collection<int, Rating>
     */
    private function getUserTopRating(): Collection
    {
        return Auth::user()
            ->ratings
            ->reject(function ($value) {
                return $value->rating < 5;
            })->take(10);
    }

    /**
     * @return array<mixed>
     */
    private function formatResponse(string $response): array
    {
        return array_map(function ($recommendation) {
            return trim($recommendation);
        }, explode(',', $response));
    }

    /**
     * @param  array<mixed>  $response
     * @return Collection<int, Movie>
     */
    private function correlateMovies(array $response): Collection
    {
        return Movie::whereIn('title', $response)->get();
    }

    /**
     * @param  Collection<int, Movie>  $movies
     */
    private function getRidOfDuplications(Collection $movies): void
    {
        $movies->groupBy('title')
            ->map(function ($groupedMovies) {
                return $groupedMovies->sortByDesc('rating')->first();
            });
    }

    /**
     * @param  Collection<int, Movie>  $movies
     * @return Collection<int, Movie>
     */
    private function limitNumberOfMovies(Collection $movies): Collection
    {
        return $movies->take(self::NUMBER_OF_RECOMMENDATIONS);
    }
}
