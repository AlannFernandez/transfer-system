<?php

namespace Src\Shared\Domain\Enums;

enum WalletStatusEnum: string
{
    case ACTIVE = 'active';
    case FROZEN = 'frozen';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Activa',
            self::FROZEN => 'Congelada',
            self::CLOSED => 'Cerrada',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ACTIVE => 'Billetera lista para operar.',
            self::FROZEN => 'Billetera bloqueada por seguridad.',
            self::CLOSED => 'Billetera dada de baja.',
        };
    }
}
