<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use Illuminate\Support\Facades\DB;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BannerEnum extends Enum
{
    const BannerLeft = 1;
    const BannerRight = 2;

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
