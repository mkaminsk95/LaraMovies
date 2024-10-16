<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'user_id',
        'movie_id'
    ];

    /**
     * @return BelongsTo<User, Rating>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Movie, Rating>
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public static function booted(): void
    {
        static::created(function (Rating $rating) {
            $review = Review::where('user_id', $rating->user_id)->where('movie_id', $rating->movie_id)->first();
            if ($review) {
                $review->update(['rating_id' => $rating->id]);
            }
        });
    }
}
