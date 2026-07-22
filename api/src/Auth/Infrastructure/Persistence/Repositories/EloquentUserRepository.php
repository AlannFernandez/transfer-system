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
            'name'              => $user->getName(),
            'last_name'         => $user->getLastName(),
            'email'             => $user->getEmail(),
            'password'          => $user->getPassword(),
            'document_type_id'  => $user->getDocumentTypeId(),
            'document'          => $user->getDocument(),
            'birth_date'        => $user->getBirthDate(),
            'nationality_id'    => $user->getNationalityId(),
            'gender_id'         => $user->getGenderId(),
            'transaction_pin'   => $user->getTransactionPin(),
        ]);

        return $this->toDomain($model);
    }

    private function toDomain(UserModel $model): UserDomain
    {
        return new UserDomain(
            id: $model->id,
            name: $model->name,
            lastName: $model->last_name,
            email: $model->email,
            password: $model->password,
            documentTypeId: (int) $model->document_type_id,
            document: $model->document,
            birthDate: $model->birth_date ? $model->birth_date->format('Y-m-d') : null,
            nationalityId: (int) $model->nationality_id,
            genderId: (int) $model->gender_id,
            transactionPin: $model->transaction_pin
        );
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


}
