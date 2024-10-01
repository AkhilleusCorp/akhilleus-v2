<?php

namespace App\Tests\integrations\UseCase\Website\Authentication;

use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\Website\Authentication\AuthenticationSuccessUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AuthenticationSuccessUseCaseTest extends AbstractIntegrationTest
{
    private AuthenticationSuccessUseCase $useCase;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new AuthenticationSuccessUseCase(
            $this->container->get(UserDataModelPersisterGateway::class)
        );
    }

    public function testForNullUser(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(null);
    }
}