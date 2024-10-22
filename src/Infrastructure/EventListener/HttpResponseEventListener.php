<?php

namespace App\Infrastructure\EventListener;

use App\Infrastructure\Registry\TokenPayloadRegistry;
use App\Infrastructure\Tools\CustomSerializer;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Serializer\Exception\LogicException;

final class HttpResponseEventListener
{
    /**
     * @var array<mixed>|null
     */
    private ?array $tokenPayload = null;

    public function __construct(private readonly JWTTokenManagerInterface $jwtTokenManager)
    {
    }

    private const EXCLUDED_API_ROUTES = [
        'app.swagger',
        'app.swagger_ui',
    ];

    public function onKernelView(ViewEvent $event): void
    {
        $request = $event->getRequest();
        $uri = $request->getRequestUri();

        if (str_starts_with($uri, '/api') && false === $this->isIgnoredRoute($request->attributes->get('_route'))) {
            $viewModel = $event->getControllerResult();
            $tokenPayload = $this->getTokenPayload($request);
            $serializer = new CustomSerializer(null === $tokenPayload ? null : $tokenPayload[TokenPayloadRegistry::PAYLOAD_DATE_FORMAT]);
            $serializationGroup = $this->getSerializationGroup($tokenPayload, $request->query->get('data-profile'));

            $event->setResponse(
                new JsonResponse(
                    $serializer->normalize($viewModel, $serializationGroup)
                )
            );
        }
    }

    private function isIgnoredRoute(string $routeName): bool
    {
        return in_array($routeName, self::EXCLUDED_API_ROUTES);
    }

    /**
     * @return array<mixed>|null
     */
    private function getTokenPayload(Request $request): ?array
    {
        if (null !== $this->tokenPayload) {
            return $this->tokenPayload;
        }

        $authorization = $request->headers->get('Authorization');
        if (null === $authorization) {
            return null;
        }

        $token = str_replace('Bearer ', '', $authorization);

        return $this->jwtTokenManager->parse($token);
    }

    /**
     * @param array<mixed>|null $tokenPayload
     */
    private function getSerializationGroup(?array $tokenPayload, ?string $userType): string
    {
        if (null === $tokenPayload) {
            throw new LogicException('Cannot serialize data without a serialization group');
        }

        $serializationGroup = $tokenPayload[TokenPayloadRegistry::PAYLOAD_USER_TYPE];
        if (null !== $userType) {
            $serializationGroup = "{$serializationGroup}-{$userType}";
        }

        return $serializationGroup;
    }
}
