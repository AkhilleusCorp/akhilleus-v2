<?php

namespace App\Infrastructure\Controller\API;

use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\DTO\TokenPayloadDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractAPIController extends AbstractController
{
    protected function getTokenPayload(Request $request): ?TokenPayloadDTO
    {
        if (false === $request->headers->hasCacheControlDirective('Authorization')) {
            return null;
        }

        $request->headers->get('Authorization');

        // Todo: extract from token in the future
        $payload = new TokenPayloadDTO();
        $payload->userId = 1;
        $payload->userType = UserTypeRegistry::USER_TYPE_MEMBER;

        // TokenPayloadRegistry::PAYLOAD_USER_ID,
        // TokenPayloadRegistry::PAYLOAD_USER_TYPE,

        return $payload;
    }
}
