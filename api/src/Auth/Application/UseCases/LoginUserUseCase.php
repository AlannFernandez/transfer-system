<?php

namespace Src\Auth\Application\UseCases;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Src\Auth\Application\Dtos\LoginInputDto;
use Src\Auth\Domain\Entities\LoginResponseDto;
use Src\Auth\Domain\Exceptions\InvalidCredentialsException;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;

readonly class LoginUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * @throws InvalidCredentialsException
     */
    public function __invoke(LoginInputDto $dto): LoginResponseDto
    {
        $user = $this->userRepository->findByEmail($dto->email);

        if (!$user || !Hash::check($dto->password, $user->getPassword())) {
            throw new InvalidCredentialsException();
        }

        // 2. Generamos el token JWT a través del Guard
        $credentials = [
            'email'    => $dto->email,
            'password' => $dto->password,
        ];

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            throw new InvalidCredentialsException();
        }

        // 3. Retornamos el DTO de respuesta estructurado
        return new LoginResponseDto(
            user: $user,
            accessToken: $token,
            expiresIn: Auth::guard('api')->factory()->getTTL() * 60
        );
    }

}
