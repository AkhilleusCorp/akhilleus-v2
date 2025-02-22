<?php

namespace App\Tests\integrations\Controller;

use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\GenericCreateOneUseCase;
use App\UseCase\API\GenericDeleteOneByIdUseCase;
use App\UseCase\API\GenericFetchManyUseCase;
use App\UseCase\API\GenericFetchOneByIdUseCase;
use App\UseCase\API\GenericGetDropdownableUseCase;
use App\UseCase\API\GenericUpdateOneByIdUseCase;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractGenericControllerTest extends AbstractIntegrationTest
{
    protected GenericFetchManyUseCase $fetchManyUseCase;
    protected GenericGetDropdownableUseCase $getDropdownableUseCase;
    protected GenericFetchOneByIdUseCase $fetchOneByIdUseCase;
    protected GenericCreateOneUseCase $createOneUseCase;
    protected GenericUpdateOneByIdUseCase $updateOneByIdUseCase;
    protected GenericDeleteOneByIdUseCase $deleteOneByIdUseCase;

    public function setUp(): void
    {
        parent::setUp();

        $this->fetchManyUseCase = $this->container->get(GenericFetchManyUseCase::class);
        $this->getDropdownableUseCase = $this->container->get(GenericGetDropdownableUseCase::class);
        $this->fetchOneByIdUseCase = $this->container->get(GenericFetchOneByIdUseCase::class);
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
