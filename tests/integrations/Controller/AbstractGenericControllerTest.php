<?php

namespace App\Tests\integrations\Controller;

use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\GenericCreateOneUseCase;
use App\UseCase\API\GenericDeleteOneByIdUseCase;
use App\UseCase\API\GenericGetDropdownableUseCase;
use App\UseCase\API\GenericGetManyUseCase;
use App\UseCase\API\GenericGetOneByIdUseCase;
use App\UseCase\API\GenericUpdateOneByIdUseCase;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractGenericControllerTest extends AbstractIntegrationTest
{
    protected GenericGetManyUseCase $getManyUseCase;
    protected GenericGetDropdownableUseCase $getDropdownableUseCase;
    protected GenericGetOneByIdUseCase $getOneByIdUseCase;
    protected GenericCreateOneUseCase $createOneUseCase;
    protected GenericUpdateOneByIdUseCase $updateOneByIdUseCase;
    protected GenericDeleteOneByIdUseCase $deleteOneByIdUseCase;

    public function setUp(): void
    {
        parent::setUp();

        $this->getManyUseCase = $this->container->get(GenericGetManyUseCase::class);
        $this->getDropdownableUseCase = $this->container->get(GenericGetDropdownableUseCase::class);
        $this->getOneByIdUseCase = $this->container->get(GenericGetOneByIdUseCase::class);
        $this->createOneUseCase = $this->container->get(GenericCreateOneUseCase::class);
        $this->updateOneByIdUseCase = $this->container->get(GenericUpdateOneByIdUseCase::class);
        $this->deleteOneByIdUseCase = $this->container->get(GenericDeleteOneByIdUseCase::class);
    }

    /**
     * @param array<mixed> $parameters
     */
    protected function createRequestWithBody(array $parameters): Request
    {
        return new Request(
            [],
            [],
            [],
            [],
            [],
            [],
            json_encode($parameters)
        );
    }
}
