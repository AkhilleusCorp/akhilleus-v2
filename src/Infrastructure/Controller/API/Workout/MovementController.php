<?php

namespace App\Infrastructure\Controller\API\Workout;

use App\Infrastructure\Controller\API\AbstractAPIController;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\UseCase\API\Workout\GetManyMovementUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class MovementController extends AbstractAPIController
{
    #[Route('/movements', name:'movement_get_many', methods: ['GET'])]
    public function getMany(Request $request, GetManyMovementUseCase $useCase): MultipleObjectViewModel
    {
        return $useCase->execute($request->query->all(), $this->getDataProfile());
    }
}