<?php

namespace Src\Auth\Domain\Entities;

class LoginResponseDto
{
    public function __construct(
        public UserDomain $user,
        public string $accessToken,
        public string $tokenType = 'bearer',
        public int $expiresIn = 3600
    ) {}
}
