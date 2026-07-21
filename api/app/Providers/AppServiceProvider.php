<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;
use Src\Auth\Infrastructure\Persistence\Repositories\EloquentUserRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}