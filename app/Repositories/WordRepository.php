<?php
/**
 * Created by PhpStorm.
 * User: Albin
 * Date: 2019-06-23
 * Time: 17:52
 */

namespace App\Repositories;

use App\Models\Word;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WordRepository implements WordRepositoryInterface
{
    public static function search($regex, $length)
    {
        $requirements = [
            [DB::raw('CHAR_LENGTH(word)'), $length],
            [DB::raw('UPPER(word)'), 'REGEXP', $regex]
        ];
        return Word::where($requirements)->get();
    }
}
