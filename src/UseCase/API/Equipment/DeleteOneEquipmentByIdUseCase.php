<?php

namespace App\UseCase\API\Equipment;

use App\Domain\Gateway\Provider\Equipment\EquipmentDataModelProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteOneEquipmentByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly EquipmentDataModelProviderGateway $provider,
    ) {

    }

    public function execute(int $id): void
    {
        $equipment = $this->provider->getOneById($id);
        if (null === $equipment) {
            throw new NotFoundHttpException("Equipment #$id cannot be found");
        }
    }
}