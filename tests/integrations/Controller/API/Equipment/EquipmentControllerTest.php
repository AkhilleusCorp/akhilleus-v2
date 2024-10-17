<?php

namespace App\Tests\integrations\Controller\API\Equipment;

use App\Domain\Factory\DataModelFactory\Equipment\EquipmentDataModelFactory;
use App\Domain\Gateway\Provider\Equipment\EquipmentDataModelProviderGateway;
use App\Infrastructure\Controller\API\Equipment\EquipmentController;
use App\Infrastructure\View\ViewModel\Equipment\SingleEquipmentDataViewModel;
use App\Tests\integrations\Controller\AbstractGenericControllerTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class EquipmentControllerTest extends AbstractGenericControllerTest
{
    protected EquipmentController $controller;
    protected EquipmentDataModelProviderGateway $provider;
    protected EquipmentDataModelFactory $dataModelFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->controller = new EquipmentController();
        $this->provider = $this->container->get(EquipmentDataModelProviderGateway::class);
        $this->dataModelFactory = $this->container->get(EquipmentDataModelFactory::class);
    }

    public function testGetManyWithoutFilters(): void
    {
        $view = $this->controller->getMany(
            new Request(),
            $this->getManyUseCase,
            $this->provider
        );

        $this->assertCount(12, $view->data);
        $this->assertEquals(12, $view->extra['pagination']->count);
    }

    public function testGetDropdownable(): void
    {
        $result = $this->controller->getDropdownable(
            $this->getDropdownableUseCase,
            $this->provider
        );

        $this->assertCount(12, $result);
    }

    public function testGetOneByExistingId(): void
    {
        $view = $this->controller->getOneById(
            1,
            $this->getOneByIdUseCase,
            $this->provider
        );

        /** @var SingleEquipmentDataViewModel $data */
        $data = $view->data;
        $this->assertEquals(1, $data->id);
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

    public function testCreateOne(): void
    {
        $view = $this->controller->createOne(
            $this->createRequestWithBody(['name' => 'Some equipment']),
            $this->createOneUseCase,
            $this->dataModelFactory
        );

        /** @var SingleEquipmentDataViewModel $data */
        $data = $view->data;
        $this->assertEquals('Some equipment', $data->name);
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

        /** @var SingleEquipmentDataViewModel $data */
        $data = $view->data;
        $this->assertEquals('A name that cannot be expected', $data->name);
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
}
