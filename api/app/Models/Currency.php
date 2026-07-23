<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Src\Shared\Domain\Enums\CurrencyEnum;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'symbol',
        'decimal_places',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'decimal_places' => 'integer',
    ];
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * Helper para buscar una moneda rápidamente usando el Enum de Dominio.
     */
    public static function findByEnum(CurrencyEnum $currencyEnum): ?self
    {
        return static::where('code', $currencyEnum->value)->first();
    }
}
