<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProductTypeEnum extends Enum
{
    const NORMAL_PRODUCT = 0;
    const PRE_ORDER_PRODUCT = 1;
    const COMING_SOON_PRODUCT = 2;

    public static function getArrWithKey(): array
    {
        $arr = [];
        $data = self::asArray();

        foreach ($data as $key => $val) {
            $index = ucwords(strtolower(str_replace('_', ' ', $key)));
            $arr[$index] = $val;
        }

        return $arr;
    }
}
