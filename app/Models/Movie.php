<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'tmdb_id',
        'original_title',
        'release_date',
        'poster_path',
        'backdrop_path',
        'vote_average',
        'vote_count',
        'overview',
        'original_language'
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function credits(): HasMany
    {
        return $this->hasMany(Credit::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function scopeWithGenre($query, $genres)
    {
        foreach ($genres as $genre) {
            $query->whereHas('genres', function ($q) use ($genre) {
                $q->where('name', $genre);
            });
        }
        return $query;
    }

    public function scopeWithTitle($query, $title)
    {
        return $query->where('title', 'like', "%$title%");
    }

    public function scopeWithYear($query, $year)
    {
        return $query->whereYear('release_date', $year);
    }

    public function scopeWithVoteAverage($query, $voteAverage)
    {
        return $query->where('vote_average', '>=', $voteAverage);
    }
}
