<?php

namespace App\UseCase\API\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyMovementsFilterModel;
use App\Domain\Factory\DataModelFactory\Workout\ExerciseDataModelFactory;
use App\Domain\Gateway\Persister\Workout\ExerciseGroupDataModelPersisterGateway;
use App\Domain\Gateway\Provider\Workout\ExerciseGroupDataModelProviderGateway;
use App\Domain\Gateway\Provider\Workout\MovementDataModelProviderGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleExerciseGroupViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AddExercisesByGroupIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly ExerciseGroupDataModelProviderGateway $groupProvider,
        private readonly MovementDataModelProviderGateway $movementProvider,
        private readonly ExerciseDataModelFactory $exerciseDataModelFactory,
        private readonly ExerciseGroupDataModelPersisterGateway $groupPersister,
        private readonly SingleExerciseGroupViewPresenter $presenter,
    ) {
    }

    public function execute(int $workoutId, int $groupId, TokenPayloadDTO $payload): SingleObjectViewModel
    {
        $group = $this->groupProvider->getExerciseGroupById($groupId);
        if (null === $group) {
            throw new NotFoundHttpException("Exercise group #$groupId cannot be found");
        }

        if ($workoutId !== $group->workout->id) {
            throw new NotFoundHttpException("Exercise group #$groupId is not part of Workout #$workoutId");
        }

        $movementFilterModel = new GetManyMovementsFilterModel();
        $movementFilterModel->ids = $group->movementIds;

        $movements = $this->movementProvider->getMovementsByFilterModel($movementFilterModel);
        if (true === empty($movements)) {
            throw new NotFoundHttpException('Movements could not be found');
        }

        foreach ($movements as $movement) {
            $exercise = $this->exerciseDataModelFactory->buildNewDataModel($group, $movement);
            $group->exercises->add($exercise);
        }

        $this->groupPersister->edit($group);

        return $this->presenter->present(
            $group,
            $payload->userType
        );
    }
}
