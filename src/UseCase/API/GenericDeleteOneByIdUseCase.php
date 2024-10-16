<?php

namespace App\UseCase\API;

use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;
use App\Infrastructure\Persister\GenericPersister;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GenericDeleteOneByIdUseCase implements UseCaseInterface
{
    public function __construct(private readonly GenericPersister $persister)
    {
    }

    public function execute(
        int $id,
        GenericDataModelProviderGateway $providerGateway,
    ): void {
        $dataModel = $providerGateway->getOneById($id);
        if (null === $dataModel) {
            throw new NotFoundHttpException();
        }

        $this->persister->remove($dataModel);
    }
}
