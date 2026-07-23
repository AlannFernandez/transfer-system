<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory; // Sin HasUuids

    protected $fillable = [
        'user_id',
        'currency',
        'balance',
        'status',
        'currency_id',
        'wallet_status_id',
        'held_balance',
    ];

    protected $casts = [
        'balance' => 'decimal:4',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(LedgerEntry::class);
    }

    // Reglas de negocio / Métodos de Dominio
    public function getAvailableBalanceAttribute(): float
    {
        return (float) $this->balance;
    }

    public function hasEnoughBalance(float $amount): bool
    {
        return $this->available_balance >= $amount;
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
