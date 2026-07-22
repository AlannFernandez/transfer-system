<?php

namespace Src\Auth\Infrastructure\Http\Resources;


use Src\Auth\Domain\Entities\UserDomain;

class RegisterUserResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(UserDomain $user): array
    {
        return [
            'user' => [
                'id'              => $user->getId(),
                'name'            => $user->getName(),
                'last_name'       => $user->getLastName(),
                'email'           => $user->getEmail(),
                'document'        => $user->getDocument(),
            ]
        ];
    }
}
