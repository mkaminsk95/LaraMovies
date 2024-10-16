<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = ['id', 'name'];

    /**
     * @return BelongsToMany<Movie>
     */
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_genre');
    }

    /**
     * @return array<string>
     */
    public static function getAllGenresArray(): array
    {
        return self::all()->pluck('name')->toArray();
    }
}
