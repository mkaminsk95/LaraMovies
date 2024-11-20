<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition(): array
    {
        return [
            'tmdb_id' => null,
            'title' => $this->faker->words(rand(1, 5), true),
            'title_pl' => $this->faker->words(rand(1, 5), true),
            'tagline' => $this->faker->sentence,
            'tagline_pl' => $this->faker->sentence,
            'original_title' => $this->faker->sentence,
            'release_date' => $this->faker->date,
            'poster_path' => $this->faker->imageUrl(),
            'vote_average' => $this->faker->randomFloat(1, 0, 10),
            'vote_count' => $this->faker->randomNumber(6),
            'overview' => $this->faker->paragraph,
            'overview_pl' => $this->faker->paragraph,
            'original_language' => array_rand(config('movie_languages')),
            'backdrop_path' => $this->faker->imageUrl(),
            'budget' => $this->faker->numberBetween(1000, 100000000),
            'revenue' => $this->faker->numberBetween(1000, 100000000),
            'runtime' => $this->faker->numberBetween(60, 180),
            'status' => 'Released',
            'adult' => $this->faker->boolean,
            'origin_country' => $this->generateMovieCountriesJson(),
        ];
    }

    private function generateMovieCountriesJson(): string
    {
        $countries = (array) array_rand(config('movie_languages'), rand(1, 3));
        $countries = array_map(function ($element) {
            return strtoupper($element);
        }, $countries);

        return json_encode($countries);
    }
}
