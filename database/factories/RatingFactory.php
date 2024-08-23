<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition(): array
    {
        return [
            'user_id' => function () {
                throw new \Exception('A User instance must be provided when creating a Review.');
            },
            'movie_id' => function () {
                throw new \Exception('A Movie instance must be provided when creating a Review.');
            },
            'rating' => random_int(1, 10),
            'processed' => false,
        ];
    }

    public function forUser(User $user): RatingFactory
    {
        return $this->state([
            'user_id' => $user->id,
        ]);
    }

    public function forMovie(Movie $movie): RatingFactory
    {
        return $this->state([
            'movie_id' => $movie->id,
        ]);
    }
}
