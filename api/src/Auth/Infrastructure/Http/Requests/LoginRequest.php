<?php

namespace Src\Auth\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Auth\Application\DTOs\LoginInputDto;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function getDTO(): LoginInputDto
    {
        return new LoginInputDto(
            email: $this->validated('email'),
            password: $this->validated('password')
        );
    }
}
