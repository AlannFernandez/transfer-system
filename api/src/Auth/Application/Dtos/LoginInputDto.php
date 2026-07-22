<?php

namespace Src\Auth\Application\DTOs;

readonly class LoginInputDto
{
    public function __construct(
        public string $email,
        public string $password
    ) {}
}