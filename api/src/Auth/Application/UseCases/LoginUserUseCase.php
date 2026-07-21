<?php

namespace Src\Auth\Application\UseCases;

use Illuminate\Support\Facades\Hash;
use Src\Auth\Application\Dtos\LoginInputDto;
use Src\Auth\Domain\Entities\UserDomain;
use Src\Auth\Domain\Exceptions\InvalidCredentialsException;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;

class LoginUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(LoginInputDto $dto): UserDomain
    {
        $user = $this->userRepository->findByEmail($dto->email);

        if (!$user || !Hash::check($dto->password, $user->getPassword())) {
            throw new InvalidCredentialsException();
        }

        return $user;
    }
}