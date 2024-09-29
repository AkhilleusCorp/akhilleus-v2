<?php

namespace App\Tests\integrations\Controller\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\MuscleDataModelFactory;
use App\Domain\Gateway\Provider\Workout\MuscleDataModelProviderGateway;
use App\Infrastructure\Controller\API\Workout\MuscleController;
use App\Tests\integrations\Controller\AbstractGenericControllerTest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class MuscleControllerTest extends AbstractGenericControllerTest
{
    public function setUp(): void
    {
        parent::setUp();

        $this->controller = new MuscleController();
        $this->provider = $this->container->get(MuscleDataModelProviderGateway::class);
        $this->dataModelFactory = $this->container->get(MuscleDataModelFactory::class);
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