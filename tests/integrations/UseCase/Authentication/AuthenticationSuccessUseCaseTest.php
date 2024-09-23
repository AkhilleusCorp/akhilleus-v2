<?php

namespace App\Tests\integrations\UseCase\Authentication;

use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\Authentication\AuthenticationSuccessUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AuthenticationSuccessUseCaseTest extends AbstractIntegrationTest
{
    private AuthenticationSuccessUseCase $useCase;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new AuthenticationSuccessUseCase();
    }

    public function testForNullUser(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(null);
    }
}