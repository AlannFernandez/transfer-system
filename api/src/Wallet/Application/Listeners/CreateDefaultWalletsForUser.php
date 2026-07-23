<?php

namespace Src\Wallet\Application\Listeners;

use Src\Auth\Domain\Events\UserRegisteredEvent;
use Src\Wallet\Application\UseCases\CreateWalletUseCase;


readonly class CreateDefaultWalletsForUser
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private CreateWalletUseCase $createWalletUseCase
    )
    {}

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $event): void
    {
        ($this->createWalletUseCase)($event->userId);
    }
}
