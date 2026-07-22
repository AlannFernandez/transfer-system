<?php

namespace Src\Auth\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Src\Auth\Application\Dtos\LoginInputDto;
use Src\Auth\Application\UseCases\LoginUserUseCase;
use Src\Auth\Domain\Exceptions\InvalidCredentialsException;
use Src\Auth\Infrastructure\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, LoginUserUseCase $useCase): JsonResponse
    {
        try {
            $dto = new LoginInputDto(
                email: $request->validated('email'),
                password: $request->validated('password')
            );

            $userDomain = $useCase->execute($dto);

            $eloquentUser = UserModel::find($userDomain->getId());
            $token = $eloquentUser->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'data'    => [
                    'user' => [
                        'id'    => $userDomain->getId(),
                        'name'  => $userDomain->getName(),
                        'email' => $userDomain->getEmail(),
                    ],
                    'token' => $token,
                ],
            ], Response::HTTP_OK);

        } catch (InvalidCredentialsException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
