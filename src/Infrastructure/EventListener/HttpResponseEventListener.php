<?php

namespace App\Infrastructure\EventListener;

use App\Infrastructure\Registry\DataProfileRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class HttpResponseEventListener
{
    private Serializer $serializer;

    public function __construct(private readonly JWTTokenManagerInterface $jwtTokenManager)
    {
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $this->serializer = new Serializer([$normalizer]);
    }

    private const EXCLUDED_API_ROUTES = [
        'app.swagger',
        'app.swagger_ui'
    ];

    public function onKernelView(ViewEvent $event): void
    {
        $request = $event->getRequest();
        $uri = $request->getRequestUri();

        if (str_starts_with($uri, '/api') && false === $this->isIgnoredRoute($request->attributes->get('_route'))) {
            $viewModel = $event->getControllerResult();

            $event->setResponse(
                new JsonResponse($this->serializer->normalize($viewModel, null, ['groups' => $this->getSerializationGroup($request)]))
            );
        }
    }

    private function isIgnoredRoute(string $routeName): bool
    {
        return in_array($routeName, self::EXCLUDED_API_ROUTES);
    }

    private function getSerializationGroup(Request $request): string
    {
        $authorization = $request->headers->get('Authorization');
        if (null === $authorization) {
            return DataProfileRegistry::DATA_PROFILE_PUBLIC;
        }

        $token = str_replace('Bearer ', '', $authorization);
        $payload = $this->jwtTokenManager->parse($token);

        $serializationGroup = $payload['user-type'];
        if ($dataProfile = $request->query->get('data-profile')) {
            $serializationGroup = "{$serializationGroup}-{$dataProfile}";
        }

        return $serializationGroup;
    }
}