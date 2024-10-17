<?php

namespace App\Tests\integrations\UseCase\Website\Authentication;

use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\Website\Authentication\AuthenticationSuccessUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AuthenticationSuccessUseCaseTest extends AbstractIntegrationTest
{
    private AuthenticationSuccessUseCase $useCase;
    private UserDataModelProviderGateway $provider;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new AuthenticationSuccessUseCase(
            $this->container->get(UserDataModelPersisterGateway::class)
        );

        $this->provider = $this->container->get(UserDataModelProviderGateway::class);
    }

    public function testForNullUser(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(null);
    }

    public function testForUser(): void
    {
        $user = $this->provider->getUserById(1);
        $this->assertNull($user->lifecycle->lastLoginDate);
        $this->useCase->execute($user);

        $user = $this->provider->getUserById(1);
        $this->assertNotNull($user->lifecycle->lastLoginDate);
    }
}
