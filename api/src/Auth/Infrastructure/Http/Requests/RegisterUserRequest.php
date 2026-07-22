<?php

namespace Src\Auth\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:100'],
            'last_name'        => ['required', 'string', 'max:100'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'         => ['required', 'string', 'min:8'],
            'document_type_id' => ['required', 'integer', 'exists:document_types,id'],
            'document_number'  => ['required', 'string', 'max:50'],
            'birth_date'       => ['required', 'date', 'before:today'],
            'nationality_id'   => ['required', 'integer', 'exists:countries,id'],
            'gender_id'        => ['required', 'integer', 'exists:genders,id'],
            'transaction_pin'  => ['nullable', 'string', 'digits:4'],
        ];
    }
}