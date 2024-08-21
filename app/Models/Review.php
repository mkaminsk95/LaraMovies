<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'movie_id', 'rating_id', 'name', 'description'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }

    public function scopeByMovie($query, $movieId)
    {
        return $query->where('movie_id', $movieId);
    }

    public function scopeByUser($query, $userId)
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
