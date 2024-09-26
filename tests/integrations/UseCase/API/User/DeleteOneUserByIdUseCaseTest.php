<?php

namespace App\Tests\integrations\UseCase\API\User;

use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Infrastructure\Repository\User\UserDataModelRepository;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\User\DeleteOneUserByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneUserByIdUseCaseTest extends AbstractIntegrationTest
{
    private DeleteOneUserByIdUseCase $useCase;
    private UserDataModelRepository $userDTORepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new DeleteOneUserByIdUseCase(
            $this->container->get(UserDataModelProviderGateway::class),
            $this->container->get(UserDataModelPersisterGateway::class)
        );

        $this->userDTORepository = $this->container->get(UserDataModelRepository::class);
    }

    public function testDeleteExistingUser(): void
    {
        $userId = 1;

        $countBeforeDelete = $this->userDTORepository->countUsersByParameters(null);
        $this->useCase->execute($userId);
        $countAfterDelete = $this->userDTORepository->countUsersByParameters(null);
        $userPostDelete = $this->userDTORepository->getUserById($userId);

        $this->assertEquals(($countBeforeDelete - 1), $countAfterDelete);
        $this->assertNull($userPostDelete);
    }

    public function testDeleteNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(666);
    }
}