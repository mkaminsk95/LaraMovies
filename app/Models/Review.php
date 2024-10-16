<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'movie_id', 'rating_id', 'name', 'description'];

    /**
     * @return BelongsTo<User, Review>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Movie, Review>
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * @return BelongsTo<Rating, Review>
     */
    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }

    /**
     * @param Builder<Review> $query
     * @param int $movieId
     * @return Builder<Review>
     */
    public function scopeByMovie(Builder $query, int $movieId): Builder
    {
        return $query->where('movie_id', $movieId);
    }

    /**
     * @param Builder<Review> $query
     * @param int $userId
     * @return Builder<Review>
     */
    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public static function booted(): void
    {
        static::created(function (Review $review) {
            $rating = Rating::where('user_id', $review->user_id)->where('movie_id', $review->movie_id)->first();
            if ($rating) {
                $review->update(['rating_id' => $rating->id]);
            }
        });
    }
}
