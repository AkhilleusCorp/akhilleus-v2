<?php

namespace App\UseCase\API\Workout;

use App\Domain\Gateway\Provider\Workout\ExerciseGroupDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\MultipleExerciseGroupViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetManyExerciseGroupUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly WorkoutDataModelProviderGateway $workoutProvider,
        private readonly ExerciseGroupDataModelProviderGateway $groupProvider,
        private readonly MultipleExerciseGroupViewPresenter $presenter,
    ) {
    }

    public function execute(int $workoutId, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): MultipleObjectViewModel
    {
        $workout = $this->workoutProvider->getWorkoutById($workoutId);
        if (null === $workout) {
            throw new NotFoundHttpException("Workout #$workoutId cannot be found");
        }

        $groups = $this->groupProvider->getManyAllGroupsByWorkout($workoutId);
        if (true === empty($groups)) {
            return new MultipleObjectViewModel();
        }

        return $this->presenter->present(
            $groups,
            $dataProfile
        );
    }
}
