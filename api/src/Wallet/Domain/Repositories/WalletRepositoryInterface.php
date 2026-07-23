<?php

namespace Src\Wallet\Domain\Repositories;

use Src\Wallet\Domain\Entities\WalletEntity;

interface WalletRepositoryInterface
{
    public function create(WalletEntity $wallet): WalletEntity;

    /**
     * Opcional: Para verificar si el usuario ya tiene una billetera en una moneda dada.
     */
    public function existsForUserAndCurrency(int $userId, int $currencyId): bool;
}
