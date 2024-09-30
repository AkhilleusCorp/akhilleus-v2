<?php

namespace App\Tests\integrations\UseCase\API\Workout;

use App\Domain\Gateway\Persister\Workout\MovementDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\Workout\DeleteOneMovementByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneMovementByIdUseCaseTest extends AbstractIntegrationTest
{
    private DeleteOneMovementByIdUseCase $useCase;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new DeleteOneMovementByIdUseCase(
            $this->container->get(MovementDataModelProviderGateway::class),
            $this->container->get(MovementDataModelPersisterGateway::class)
        );
    }

    public function testDeleteNonExistingMovement(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(666);
    }
}