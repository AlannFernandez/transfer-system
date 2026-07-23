<?php

namespace Src\Shared\Domain\Enums;

enum CurrencyEnum: string
{
    case USD = 'USD';
    case ARS = 'ARS';
    case EUR = 'EUR';

    public function name(): string
    {
        return match ($this) {
            self::USD => 'Dólar Estadounidense',
            self::ARS => 'Peso Argentino',
            self::EUR => 'Euro',
        };
    }

    public function symbol(): string
    {
        return match ($this) {
            self::USD, self::ARS => '$',
            self::EUR => '€',
        };
    }

    public function decimalPlaces(): int
    {
        return 2; // O 4 si manejás cripto/fracciones menores
    }
}
