<?php

namespace Src\Auth\Application\UseCases;

use Src\Auth\Application\DTOs\RegisterUserDto;
use Src\Auth\Domain\Entities\UserDomain;
// use Src\Auth\Domain\Events\UserRegisteredEvent;
use Src\Auth\Domain\Events\UserRegisteredEvent;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;


readonly class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {}

    public function execute(RegisterUserDto $dto): UserDomain
    {
        $userDomain = new UserDomain(
            id: null,
            name: $dto->name,
            lastName: $dto->lastName,
            email: $dto->email,
            password: $dto->password, // Consider hashing the password here if needed
            documentTypeId: $dto->documentTypeId,
            document: $dto->document,
            birthDate: $dto->birthDate,
            nationalityId: $dto->nationalityId,
            genderId: $dto->genderId,
            transactionPin: null
        );

        $userSaved = $this->userRepository->save($userDomain);

        UserRegisteredEvent::dispatch($userSaved->getId());

        return $userSaved;
    }
}
