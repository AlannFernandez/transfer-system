<?php

namespace Src\Wallet\Infrastructure\Persistence\Repositories;

use App\Models\Currency;
use App\Models\Wallet;
use App\Models\WalletStatus;
use Src\Wallet\Domain\Entities\WalletEntity;
use Src\Wallet\Domain\Repositories\WalletRepositoryInterface;

class EloquentWalletRepository implements WalletRepositoryInterface
{
    public function create(WalletEntity $wallet): WalletEntity
    {
        {
            // Recuperamos los IDs de la base de datos basándonos en los Enums de la Entidad
            $currencyModel = Currency::findByEnum($wallet->currency);
            $statusModel   = WalletStatus::findByEnum($wallet->status);

            $model = Wallet::create([
                'user_id'          => $wallet->userId,
                'currency_id'      => $currencyModel->id,
                'wallet_status_id' => $statusModel->id,
                'balance'          => $wallet->balance,
                'held_balance'     => $wallet->heldBalance,
            ]);

            return new WalletEntity(
                id: $model->id,
                userId: $model->user_id,
                currency: $wallet->currency,
                status: $wallet->status,
                balance: (float) $model->balance,
                heldBalance: (float) $model->held_balance
            );
        }
    }

    public function existsForUserAndCurrency(int $userId, int $currencyId): bool
    {
        return Wallet::where('user_id', $userId)
            ->where('currency_id', $currencyId)
            ->exists();
    }
}
