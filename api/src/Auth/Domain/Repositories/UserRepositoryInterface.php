<?php

namespace Src\Auth\Domain\Repositories;

use Src\Auth\Domain\Entities\UserDomain;

interface UserRepositoryInterface
{
    public function save(UserDomain $user): UserDomain;
    public function findByEmail(string $email): ?UserDomain;
    public function findById(int $id): ?UserDomain;
}