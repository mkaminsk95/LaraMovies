<?php

namespace Database\Seeders;

use App\Models\Favourite;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Review;
use App\Models\User;
use App\Models\WatchlistItem;
use App\Services\RandomChanceGenerator as ChanceGenerator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class DummyMovieUserInteractionsSeeder extends Seeder
{
    public function run(): void
    {
        // Delete all users with is_dummy = true
        User::where('is_dummy', true)->get()->each(function ($user) {
            $user->delete();
        });

        // Create new dummy users
        $users = User::factory(40)->create();  // Creating 40 users

        $this->seedDummyInteractions($users);
    }

    private function seedDummyInteractions(Collection $users): void
    {
        Movie::all()->each(function ($movie) use ($users) {
            echo "Movie Id: " . $movie->id . PHP_EOL;
            for ($i = 0; $i < rand(1, 10); $i++) {
                $user = $users->random();

                if (ChanceGenerator::generate(80)) {
                    $this->simulateWatched($movie, $user);
                } else {
                    $this->simulateAddToWatchlist($movie, $user);
                }
            }
        });
    }

    private function simulateWatched(Movie $movie, User $user): void
    {
        Review::factory()->forMovie($movie)->forUser($user)->create();

        $rating = Rating::factory()->forMovie($movie)->forUser($user)->create();
        if ($rating->rating > 7 && ChanceGenerator::generate(20)) {
            // Add this movie to favorites
            Favourite::create([
                'user_id' => $user->id,
                'movie_id' => $movie->id,
            ]);
        }
    }

    private function simulateAddToWatchlist(Movie $movie, User $user): void
    {
        // Add the movie to the user's watchlist
        WatchlistItem::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);
    }
}
