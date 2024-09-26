<?php

namespace App\Infrastructure\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

final class JWTTokenCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $payload = $event->getData();
        $payload['user-type'] = $event->getUser()->type;

        $event->setData($payload);

        $event->setHeader($event->getHeader());
    }
}