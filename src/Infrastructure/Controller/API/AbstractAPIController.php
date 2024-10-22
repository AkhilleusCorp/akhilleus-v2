<?php

namespace App\Infrastructure\Controller\API;

use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\Registry\DataProfileRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class AbstractAPIController extends AbstractController
{
    private Request $currentRequest;

    public function __construct(
        protected RequestStack $requestStack,
    ) {
        $this->currentRequest = $requestStack->getCurrentRequest();
    }

    protected function getDataProfile(): string
    {
        $dataProfile = $this->getTokenPayload()->userType;
        if (null !== $this->currentRequest->query->has('data-profile')) {
            // Todo build data profile based on user-type and request parameter
        }

        return $dataProfile;
    }

    protected function getTokenPayload(): TokenPayloadDTO
    {
        $this->currentRequest->headers->get('Authorization');

        // Todo: extract from token in the future
        $payload = new TokenPayloadDTO();
        $payload->userId = 1;
        $payload->userType = DataProfileRegistry::DATA_PROFILE_MEMBER;

        // TokenPayloadRegistry::PAYLOAD_USER_ID,
        // TokenPayloadRegistry::PAYLOAD_USER_TYPE,

        return $payload;
    }
}
