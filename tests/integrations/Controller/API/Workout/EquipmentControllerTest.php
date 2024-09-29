<?php

namespace App\Tests\integrations\Controller\API\Workout;

use App\Domain\Factory\DataModelFactory\Equipment\EquipmentDataModelFactory;
use App\Domain\Gateway\Provider\Workout\EquipmentDataModelProviderGateway;
use App\Infrastructure\Controller\API\Workout\EquipmentController;
use App\Tests\integrations\Controller\AbstractGenericControllerTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class EquipmentControllerTest extends AbstractGenericControllerTest
{
    private EquipmentController $controller;
    private EquipmentDataModelProviderGateway $provider;

    private EquipmentDataModelFactory $dataModelFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->controller = new EquipmentController();
        $this->provider = $this->container->get(EquipmentDataModelProviderGateway::class);
        $this->dataModelFactory = $this->container->get(EquipmentDataModelFactory::class);
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

    public function testGetManyWithoutFilters(): void
    {
        $view = $this->controller->getMany(
            new Request(),
            $this->getManyUseCase,
            $this->provider
        );

        $this->assertCount(25, $view->data);
        $this->assertEquals(53, $view->extra['pagination']->count);
    }

    public function testCreateOne(): void
    {
        $view = $this->controller->createOne(
            $this->createRequestWithBody(['name' => 'Some equipment']),
            $this->createOneUseCase,
            $this->dataModelFactory
        );

        $this->assertEquals('Some equipment', $view->data->name);
    }

    public function testUpdateOneByExistingId(): void
    {
        $view = $this->controller->updateOneById(
            1,
            $this->createRequestWithBody(['name' => 'A name that cannot be expected']),
            $this->updateOneByIdUseCase,
            $this->provider,
            $this->dataModelFactory
        );

        $this->assertEquals('A name that cannot be expected', $view->data->name);
    }

    public function testUpdateOneByNonExistingId(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->controller->updateOneById(
            666,
            $this->createRequestWithBody(['name' => 'A name that cannot be expected']),
            $this->updateOneByIdUseCase,
            $this->provider,
            $this->dataModelFactory
        );
    }

    public function testDeleteOneByExistingId(): void
    {
        $this->controller->deleteOnById(
            1,
            $this->deleteOneByIdUseCase,
            $this->provider
        );

        $this->assertNull($this->provider->getOneById(1));
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

    private function createRequestWithBody(array $parameters): Request
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