<?php

namespace App\Infrastructure\EventListener;

use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

final class HttpRequestEventListener
{
    public function __construct(
        private readonly UserDataModelProviderGateway $provider,
        private readonly JWTTokenManagerInterface $tokenManager,
        private readonly string $env,
        private readonly ?int $autoTokenUserId,
    ) {
    }

    public function onKernelController(ControllerEvent $event): void
    {
        if ('dev' !== $this->env
            || null === $this->autoTokenUserId
            || $event->getRequest()->headers->has('Authorization')
        ) {
            return;
        }

        $user = $this->provider->getUserById($this->autoTokenUserId);
        if (null === $user) {
            return;
        }

        $token = $this->tokenManager->create($user);

        $event->getRequest()->headers->set('Authorization', "Bearer {$token}");
    }
}
