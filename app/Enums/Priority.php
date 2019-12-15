<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Priority extends Enum
{
    const Low =   1;
    const Mid =   2;
    const High = 3;
}
