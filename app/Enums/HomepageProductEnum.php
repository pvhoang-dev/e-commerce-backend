<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class HomepageProductEnum extends Enum
{
    const MOBILE = 0;
    const LAPTOP = 1;
    const PC = 2;
}
