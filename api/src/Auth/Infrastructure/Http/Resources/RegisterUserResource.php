<?php

namespace Src\Auth\Infrastructure\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'id'              => $this['user']->id,
                'name'            => $this['user']->name,
                'last_name'       => $this['user']->lastName,
                'email'           => $this['user']->email,
                'document_number' => $this['user']->documentNumber,
            ],
            'wallet' => [
                'id'       => $this['wallet']->id,
                'currency' => $this['wallet']->currency,
                'balance'  => $this['wallet']->balance,
                'status'   => $this['wallet']->status->value,
            ],
        ];
    }
}