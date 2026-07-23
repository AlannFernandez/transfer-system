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
    public function __construct(
        private readonly LoginUserUseCase $loginUserUseCase
    ) {}
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $responseDto = ($this->loginUserUseCase)($request->getDTO());

            return response()->json([
                'status' => 'success',
                'data'   => [
                    'user' => [
                        'id'    => $responseDto->user->getId(),
                        'name'  => $responseDto->user->getName(),
                        'email' => $responseDto->user->getEmail(),
                    ],
                    'authorization' => [
                        'access_token' => $responseDto->accessToken,
                        'token_type'   => $responseDto->tokenType,
                        'expires_in'   => $responseDto->expiresIn,
                    ]
                ]
            ]);

        } catch (InvalidCredentialsException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
