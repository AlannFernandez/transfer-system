<?php

namespace Src\Wallet\Domain\Entities;

use Src\Shared\Domain\Enums\CurrencyEnum;
use Src\Shared\Domain\Enums\WalletStatusEnum;

readonly class WalletEntity
{
    public function __construct(
        public ?int             $id,
        public int              $userId,
        public CurrencyEnum     $currency,
        public WalletStatusEnum $status = WalletStatusEnum::ACTIVE,
        public float            $balance = 0.0,
        public float            $heldBalance = 0.0
    ) {}
}
