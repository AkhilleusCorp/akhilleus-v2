<?php

namespace App\Tests\integrations\Controller\API\Workout;

use App\Domain\Factory\DataModelFactory\Workout\MuscleDataModelFactory;
use App\Domain\Gateway\Provider\Workout\MuscleDataModelProviderGateway;
use App\Infrastructure\Controller\API\Workout\MuscleController;
use App\Infrastructure\View\ViewModel\Workout\SingleMuscleDataViewModel;
use App\Tests\integrations\Controller\AbstractGenericControllerTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class MuscleControllerTest extends AbstractGenericControllerTest
{
    protected MuscleController $controller;
    protected MuscleDataModelProviderGateway $provider;
    private MuscleDataModelFactory $dataModelFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->controller = new MuscleController();
        $this->provider = $this->container->get(MuscleDataModelProviderGateway::class);
        $this->dataModelFactory = $this->container->get(MuscleDataModelFactory::class);
    }

    public function testGetManyWithoutFilters(): void
    {
        $view = $this->controller->getMany(
            new Request(),
            $this->getManyUseCase,
            $this->provider
        );

        $this->assertCount(20, $view->data);
        $this->assertEquals(20, $view->extra['pagination']->count);
    }

    public function testGetDropdownable(): void
    {
        $result = $this->controller->getDropdownable(
            $this->getDropdownableUseCase,
            $this->provider
        );

        $this->assertCount(20, $result);
    }

    public function testGetOneByExistingId(): void
    {
        $view = $this->controller->getOneById(
            1,
            $this->getOneByIdUseCase,
            $this->provider
        );

        /** @var SingleMuscleDataViewModel $data */
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
            $this->createRequestWithBody(['name' => 'Some muscle']),
            $this->createOneUseCase,
            $this->dataModelFactory
        );

        /** @var SingleMuscleDataViewModel $data */
        $data = $view->data;
        $this->assertEquals('Some muscle', $data->name);
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

        /** @var SingleMuscleDataViewModel $data */
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
