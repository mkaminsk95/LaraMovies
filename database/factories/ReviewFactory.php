<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->sentences(random_int(3, 7), true),
            'user_id' => function () {
                throw new \Exception('A User instance must be provided when creating a Review.');
            },
            'movie_id' => function () {
                throw new \Exception('A Movie instance must be provided when creating a Review.');
            },
            'rating_id' => null,
        ];
    }

    public function forUser(User $user): ReviewFactory
    {
        return $this->state([
            'user_id' => $user->id,
        ]);
    }

    public function forMovie(Movie $movie): ReviewFactory
    {
        return $this->state([
            'movie_id' => $movie->id,
        ]);
    }
}
