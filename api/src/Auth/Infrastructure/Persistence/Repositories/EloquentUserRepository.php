<?php

namespace Src\Auth\Infrastructure\Persistence\Repositories;

use App\Models\User as UserModel;
use Src\Auth\Domain\Entities\UserDomain;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function save(UserDomain $user): UserDomain
    {
        $model = UserModel::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'transaction_pin' => $user->getTransactionPin(),
        ]);

        return $this->toDomain($model);
    }

    public function findByEmail(string $email): ?UserDomain
    {
        $model = UserModel::where('email', $email)->first();
        return $model ? $this->toDomain($model) : null;
    }

    public function findById(int $id): ?UserDomain
    {
        $model = UserModel::find($id);
        return $model ? $this->toDomain($model) : null;
    }

    private function toDomain(UserModel $model): UserDomain
    {
        return new UserDomain(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            password: $model->password,
            transactionPin: $model->transaction_pin
        );
    }
}