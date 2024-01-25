<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use Illuminate\Support\Facades\DB;

final class HomepageProductEnum extends Enum
{
    const MOBILE = 1;
    const LAPTOP = 2;
    const PC = 3;

    public static function getArrWithLowerKey(): array
    {
        $arr = [];
        $data = self::asArray();

        foreach ($data as $key => $val) {
            $index = $key;
            $arr[$index] = $val;
        }

        return $arr;
    }
}
