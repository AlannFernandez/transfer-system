<?php

namespace Src\Wallet\Application\UseCases;

use Src\Shared\Domain\Enums\CurrencyEnum;
use Src\Wallet\Domain\Entities\WalletEntity;
use Src\Wallet\Domain\Repositories\WalletRepositoryInterface;

readonly class CreateWalletUseCase
{
    public function __construct(
        private WalletRepositoryInterface $walletRepository
    ) {}

    public function __invoke(int $userId, CurrencyEnum $currency = CurrencyEnum::USD): WalletEntity
    {
        // Instanciamos el Entity con el Enum directo
        $wallet = new WalletEntity(
            id: null,
            userId: $userId,
            currency: $currency
        );

        // El repositorio se encarga de traducir los Enums a IDs de BD al guardar
        return $this->walletRepository->create($wallet);
    }
}
