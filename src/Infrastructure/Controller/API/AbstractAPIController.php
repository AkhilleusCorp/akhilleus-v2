<?php

namespace App\Infrastructure\Controller\API;

use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\Registry\TokenPayloadRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

abstract class AbstractAPIController extends AbstractController
{
    public function __construct(private readonly JWTTokenManagerInterface $tokenManager)
    {
    }

    protected function getTokenPayload(Request $request): ?TokenPayloadDTO
    {
        if (false === $request->headers->has('Authorization')) {
            return null;
        }

        $encodedToken = str_replace('Bearer ', '', $request->headers->get('Authorization'));

        try {
            $decodedToken = $this->tokenManager->parse($encodedToken);
        } catch (JWTDecodeFailureException $exception) {
            throw new AccessDeniedHttpException($exception->getMessage());
        }

        $payload = new TokenPayloadDTO();
        $payload->userId = $decodedToken[TokenPayloadRegistry::PAYLOAD_USER_ID];
        $payload->userType = $decodedToken[TokenPayloadRegistry::PAYLOAD_USER_TYPE];

        return $payload;
    }
}
