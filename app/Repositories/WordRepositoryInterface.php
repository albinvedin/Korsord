<?php
/**
 * Created by PhpStorm.
 * User: Albin
 * Date: 2019-06-23
 * Time: 17:51
 */

namespace App\Repositories;

interface WordRepositoryInterface
{
    public static function search($regex, $length);
}
