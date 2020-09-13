<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parser extends Model
{
    const WILDCARD = '.';

    public static function parse(string $input)
    {
        $trimmed = rtrim($input);
        $upper = mb_strtoupper($trimmed, 'utf8');
        $parsed = str_replace(self::WILDCARD, "\w", $upper);
        return $parsed;
    }
}
