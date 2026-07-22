<?php

namespace Src\Auth\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Src\Auth\Infrastructure\Http\Requests\RegisterUserRequest;
use Src\Auth\Infrastructure\Http\Resources\RegisterUserResource;
use Src\Auth\Application\DTOs\RegisterUserDto;
use Src\Auth\Application\UseCases\RegisterUserUseCase;

class RegisterController extends Controller
{
    public function __construct(
        private readonly RegisterUserUseCase $registerUserUseCase
    ) {}

    public function __invoke(RegisterUserRequest $request): RegisterUserResource
    {
        $dto = RegisterUserDto::fromArray($request->validated());

        $result = $this->registerUserUseCase->execute($dto);

        return new RegisterUserResource($result);
    }
}
