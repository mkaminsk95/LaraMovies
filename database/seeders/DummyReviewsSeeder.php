<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummyReviewsSeeder extends Seeder
{
    public function run(): void
    {
        // Delete all users with is_dummy = true
        User::where('is_dummy', true)->get()->each(function ($user) {
            $user->delete();
        });

        // Create new dummy users
        $users = User::factory(40)->create();  // Creating 40 users

        // For each movie, create 1 to 5 reviews
        Movie::all()->each(function ($movie) use ($users) {
            echo "Movie Id: ".$movie->id.PHP_EOL;
            Review::factory(rand(1, 5))->forMovie($movie)->forUser($users->random())->create();
        });
    }
}
