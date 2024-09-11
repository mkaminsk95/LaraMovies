<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Credit extends Model
{
    const DEPARTMENT_ACTING = 'Acting';
    const DEPARTMENT_DIRECTING = 'Directing';
    const DEPARTMENT_WRITING = 'Writing';
    const DEPARTMENT_PRODUCTION = 'Production';
    const JOB_DIRECTOR = 'Director';
    const JOB_SCREENPLAY = 'Screenplay';

    public $timestamps = false;

    protected $fillable = [
        'movie_id', 'person_id', 'character', 'order', 'department'
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function scopeWithDepartment($query, $department): void
    {
        $query->where('department', $department);
    }
}
