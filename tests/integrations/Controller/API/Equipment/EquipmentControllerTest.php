<?php

namespace App\Tests\integrations\Controller\API\Equipment;

use App\Domain\Factory\DataModelFactory\Equipment\EquipmentDataModelFactory;
use App\Domain\Gateway\Provider\Equipment\EquipmentDataModelProviderGateway;
use App\Infrastructure\Controller\API\Equipment\EquipmentController;
use App\Infrastructure\Controller\API\GenericAPIControllerInterface;
use App\Tests\integrations\Controller\AbstractGenericControllerTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class EquipmentControllerTest extends AbstractGenericControllerTest
{
    public function setUp(): void
    {
        parent::setUp();

        $this->controller = new EquipmentController();
        $this->provider = $this->container->get(EquipmentDataModelProviderGateway::class);
        $this->dataModelFactory = $this->container->get(EquipmentDataModelFactory::class);
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
}