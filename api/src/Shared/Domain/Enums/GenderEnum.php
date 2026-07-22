<?php

namespace Src\Shared\Domain\Enums;

enum GenderEnum: string
{
    case MALE = 'M';
    case FEMALE = 'F';
    case OTHER = 'OTHER';

    public function label(): string
    {
        return match($this) {
            self::MALE   => 'Masculino',
            self::FEMALE => 'Femenino',
            self::OTHER  => 'Otro',
        };
    }
}