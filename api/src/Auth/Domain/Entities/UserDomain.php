<?php

namespace Src\Auth\Domain\Entities;

class UserDomain
{
    public function __construct(
        private ?int $id,
        private string $name,
        private ?string $lastName,
        private string $email,
        private string $password,
        private ?int $documentTypeId = null,
        private ?string $documentNumber = null,
        private ?string $birthDate = null,
        private ?int $nationalityId = null,
        private ?int $genderId = null,
        private ?string $transactionPin = null
    ) {}

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getLastName(): ?string { return $this->lastName; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getDocumentTypeId(): ?int { return $this->documentTypeId; }
    public function getDocumentNumber(): ?string { return $this->documentNumber; }
    public function getBirthDate(): ?string { return $this->birthDate; }
    public function getNationalityId(): ?int { return $this->nationalityId; }
    public function getGenderId(): ?int { return $this->genderId; }
    public function getTransactionPin(): ?string { return $this->transactionPin; }
}