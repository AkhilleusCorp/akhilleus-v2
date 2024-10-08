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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function testGetOneByExistingId(): void
    {
        $view = $this->controller->getOneById(
            1,
            $this->getOneByIdUseCase,
            $this->provider
        );

        $this->assertEquals(1, $view->data->id);
    }

    public function testGetOneByNonExistingId(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->controller->getOneById(
            666,
            $this->getOneByIdUseCase,
            $this->provider
        );
    }

    public function testDeleteOneByNonExistingId(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->controller->deleteOnById(
            666,
            $this->deleteOneByIdUseCase,
            $this->provider
        );
    }

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