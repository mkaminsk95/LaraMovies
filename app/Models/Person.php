<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'tmdb_id',
        'gender',
        'biography',
        'birthday',
        'deathday',
        'popularity',
        'profile_path',
    ];

    protected $casts = [
        'birthday' => 'date',
        'deathday' => 'date',
    ];

    /**
     * @return HasMany<Credit>
     */
    public function credits(): HasMany
    {
        return $this->hasMany(Credit::class);
    }
}
