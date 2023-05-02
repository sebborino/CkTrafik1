<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TicketTransferType extends Enum
{
    const Buying = 'Ticket Payment';
    const Change = 'Change Ticket';
    const Void = 'Void Ticket';
}
