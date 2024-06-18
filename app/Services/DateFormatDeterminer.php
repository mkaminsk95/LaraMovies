<?php
declare(strict_types=1);

namespace App\Services;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

class DateFormatDeterminer
{
    public static function determine($dateString): bool|string
    {
        $formats = [
            'Y-m-d',
            'm/d/Y',
            'd/m/Y',
            'Y-m-d H:i:s',
            'm/d/Y H:i:s',
            'd/m/Y H:i:s',
            'Y-m-d\TH:i:sP',
            'D, d M Y H:i:s O',
            // Add more formats as needed
        ];

        // Iterate over each format and try to create a Carbon object
        foreach ($formats as $format) {
            try {
                $date = Carbon::createFromFormat($format, $dateString);
                if ($date && $date->format($format) === $dateString) {
                    return $format;
                }
            } catch (InvalidFormatException $e) {
                continue;
            }
        }

        // Return false if no format matches
        return false;
    }
}
