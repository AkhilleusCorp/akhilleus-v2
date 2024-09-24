<?php

namespace App\UseCase\Workout;

use App\Domain\Gateway\Provider\Workout\WorkoutDTOProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\Workout\SingleWorkoutViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneWorkoutByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly WorkoutDTOProviderGateway $provider,
        private readonly SingleWorkoutViewPresenter $presenter,
    ) {

    }

    public function execute(int $id, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): SingleWorkoutViewModel
    {
        $workout = $this->provider->getWorkoutById($id);
        if (null === $workout) {
            throw new NotFoundHttpException("Workout #$id cannot be found");
        }

        return $this->presenter->present($workout, $dataProfile);
    }
}