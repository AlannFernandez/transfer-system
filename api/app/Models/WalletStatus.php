<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Src\Shared\Domain\Enums\WalletStatusEnum;

class WalletStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
    ];
    /**
     * Relación: Un estado puede pertenecer a muchas billeteras.
     */
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * Helper para buscar un modelo de estado rápido mediante el Enum de Dominio.
     */
    public static function findByEnum(WalletStatusEnum $statusEnum): ?self
    {
        return static::where('code', $statusEnum->value)->first();
    }
}
