<?php

namespace Src\Auth\Domain\Entities;

class UserDomain
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $email,
        private string $password,
        private ?string $transactionPin = null
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getTransactionPin(): ?string { return $this->transactionPin; }
}