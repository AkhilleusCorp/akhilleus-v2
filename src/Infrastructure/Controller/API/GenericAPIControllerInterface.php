<?php

namespace App\Infrastructure\Controller\API;

use App\Domain\Factory\DataModelFactory\DataModelFactoryInterface;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\UseCase\API\GenericCreateOneUseCase;
use App\UseCase\API\GenericDeleteOneByIdUseCase;
use App\UseCase\API\GenericGetManyUseCase;
use App\UseCase\API\GenericGetOneByIdUseCase;
use App\UseCase\API\GenericUpdateOneByIdUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface GenericAPIControllerInterface
{
    public function getMany(Request $request, GenericGetManyUseCase $useCase, GenericDataModelProviderGateway $providerGateway): MultipleObjectViewModel;

    public function getOneById(int $id, GenericGetOneByIdUseCase $useCase, GenericDataModelProviderGateway $providerGateway): SingleObjectViewModel;
    public function createOne(Request $request, GenericCreateOneUseCase $useCase, DataModelFactoryInterface $dataModelFactory): SingleObjectViewModel;

    public function updateOneById(
        int $id,
        Request $request,
        GenericUpdateOneByIdUseCase $useCase,
        GenericDataModelProviderGateway $providerGateway,
        DataModelFactoryInterface $dataModelFactory
    ): SingleObjectViewModel;

    public function deleteOnById(int $id, GenericDeleteOneByIdUseCase $useCase, GenericDataModelProviderGateway $providerGateway): JsonResponse;
}