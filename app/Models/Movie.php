<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    use HasFactory;
}
