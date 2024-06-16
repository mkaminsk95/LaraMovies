<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }
}
