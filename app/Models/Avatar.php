<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'path'
    ];
}
