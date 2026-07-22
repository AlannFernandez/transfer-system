<?php

namespace Src\Auth\Application\UseCases;

use Src\Auth\Application\DTOs\RegisterUserDto;
use Src\Auth\Domain\Entities\UserDomain;
// use Src\Auth\Domain\Events\UserRegisteredEvent;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;
// use Src\Shared\Domain\Contracts\EventDispatcherInterface;
// use Src\Shared\Domain\Services\HashServiceInterface;

class RegisterUserUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        // private readonly HashServiceInterface $hashService,
        // private readonly EventDispatcherInterface $eventDispatcher
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
            documentNumber: $dto->documentNumber,
            birthDate: $dto->birthDate,
            nationalityId: $dto->nationalityId,
            genderId: $dto->genderId,
            transactionPin: null
        );

        $savedUser = $this->userRepository->save($userDomain);



        return $savedUser;
    }
}
