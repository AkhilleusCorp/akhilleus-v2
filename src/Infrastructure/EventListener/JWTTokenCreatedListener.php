<?php

namespace App\Infrastructure\EventListener;

use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Infrastructure\Registry\TokenPayloadRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

final class JWTTokenCreatedListener
{

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        /** @var UserDataModel $user */
        $user = $event->getUser();

        $payload = $event->getData();
        $payload[TokenPayloadRegistry::PAYLOAD_USER_TYPE] = $user->type;
        $payload[TokenPayloadRegistry::PAYLOAD_DATE_FORMAT] = $user->configuration->dateFormat;

        $event->setData($payload);

        $event->setHeader($event->getHeader());
    }
}