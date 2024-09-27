<?php

namespace App\Infrastructure\EventListener;

use App\Infrastructure\Registry\TokenPayloadRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

final class JWTTokenCreatedListener
{

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $payload = $event->getData();
        $payload[TokenPayloadRegistry::PAYLOAD_USER_TYPE] = $event->getUser()->type;
        $payload[TokenPayloadRegistry::PAYLOAD_DATE_FORMAT] = 'd/M/y h:i:s';

        $event->setData($payload);

        $event->setHeader($event->getHeader());
    }
}