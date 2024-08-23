<?php
declare(strict_types=1);

namespace App\Services;

class RandomChanceGenerator
{
    public static function generate(int $percent): bool
    {
        if ($percent < 0 || $percent > 100) {
            throw new \InvalidArgumentException('The percentage must be between 0 and 100.');
        }

        return rand(1, 100) <= $percent;
    }
}
