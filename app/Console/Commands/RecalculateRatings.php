<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;

class RecalculateRatings extends Command
{
    protected $signature = 'app:recalculate-ratings';
    protected $description = 'Command for recalculating rating with new entries.';

    public function __construct(
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        // Get all ratings that have not been processed yet
        $ratings = DB::table('ratings')
            ->where('processed', false)
            ->get();

        // Loop through all ratings and update the rating for the movie
        foreach ($ratings as $rating) {
            /** @var Movie $movie */
            $movie = Movie::find($rating->movie_id);
            $newRating = ($movie->vote_average * $movie->vote_count + $rating->rating) / ($movie->vote_count + 1);
            $movie->vote_average = (float)number_format($newRating, 6, '.', '');
            $movie->vote_count += 1;
            $movie->save();

            // Mark the rating as processed
            DB::table('ratings')
                ->where('id', $rating->id)
                ->update(['processed' => true]);
        }
    }
}
