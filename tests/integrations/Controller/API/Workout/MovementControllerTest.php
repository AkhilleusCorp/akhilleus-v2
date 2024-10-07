<?php

namespace App\Tests\integrations\Controller\API\Workout;

use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\Controller\API\Workout\MovementController;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\GenericGetDropdownableUseCase;

final class MovementControllerTest extends AbstractIntegrationTest
{
    private MovementController $controller;
    private MovementDataModelProviderGateway $provider;

    public function setUp(): void
    {
        parent::setUp();

        $this->controller = new MovementController();
        $this->provider = $this->container->get(MovementDataModelProviderGateway::class);
    }

    public function testGetDropdownable(): void
    {
        $result = $this->controller->getDropdownable(
            $this->container->get(GenericGetDropdownableUseCase::class),
            $this->provider
        );

        $this->assertCount(6, $result);
    }
}