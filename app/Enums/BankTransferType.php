<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BankTransferType extends Enum
{
    const DEPOSIT = 'Deposit';
    const WITHDRAW = 'Withdraw';
    const PAY = 'Pay';
    const CANCELLED = 'Cancelled';
    const REFUND = 'Refund';
    const VOID = 'Void';
}
