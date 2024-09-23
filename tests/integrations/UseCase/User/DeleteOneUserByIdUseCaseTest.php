<?php

namespace App\Tests\integrations\UseCase\User;

use App\Domain\Gateway\Persister\User\UserDTOPersisterGateway;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Infrastructure\Repository\User\UserDTORepository;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\User\DeleteOneUserByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneUserByIdUseCaseTest extends AbstractIntegrationTest
{
    private DeleteOneUserByIdUseCase $useCase;
    private UserDTORepository $userDTORepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new DeleteOneUserByIdUseCase(
            $this->container->get(UserDTOProviderGateway::class),
            $this->container->get(UserDTOPersisterGateway::class)
        );

        $this->userDTORepository = $this->container->get(UserDTORepository::class);
    }

    public function testDeleteExistingUser(): void
    {
        $countBeforeDelete = $this->userDTORepository->countUsersByParameters(null);
        $this->useCase->execute(1);
        $countAfterDelete = $this->userDTORepository->countUsersByParameters(null);

        $this->assertEquals(($countBeforeDelete - 1), $countAfterDelete);
    }

    public function testDeleteNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(666);
    }
}