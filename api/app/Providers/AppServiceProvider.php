<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Src\Auth\Domain\Events\UserRegisteredEvent;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;
use Src\Auth\Infrastructure\Persistence\Repositories\EloquentUserRepository;
use Src\Wallet\Application\Listeners\CreateDefaultWalletsForUser;
use Src\Wallet\Domain\Repositories\WalletRepositoryInterface;
use Src\Wallet\Infrastructure\Persistence\Repositories\EloquentWalletRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            WalletRepositoryInterface::class,
            EloquentWalletRepository::class
        );
    }

    public function boot(): void
    {
        Event::listen(
            UserRegisteredEvent::class,
            CreateDefaultWalletsForUser::class
        );
    }
}
