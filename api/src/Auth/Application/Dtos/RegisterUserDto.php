<?php

namespace Src\Auth\Application\DTOs;

readonly class RegisterUserDto
{
    public function __construct(
        public string  $name,
        public string  $lastName,
        public string  $email,
        public string  $password,
        public int     $documentTypeId,
        public string  $document,
        public string  $birthDate,
        public int     $nationalityId,
        public int     $genderId,
        public ?string $transactionPin = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            lastName: $data['last_name'],
            email: $data['email'],
            password: $data['password'],
            documentTypeId: (int) $data['document_type_id'],
            document: $data['document'],
            birthDate: $data['birth_date'],
            nationalityId: (int) $data['nationality_id'],
            genderId: (int) $data['gender_id'],
            transactionPin: $data['transaction_pin'] ?? null
        );
    }
}
