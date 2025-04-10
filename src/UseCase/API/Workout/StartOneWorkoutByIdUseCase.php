<?php

namespace App\UseCase\API\Workout;

use App\Domain\DataTransformer\WorkoutStatusDataTransformer;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Domain\Registry\Workout\WorkoutStatusRegistry;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\Persister\Workout\WorkoutDataModelPersister;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\SingleWorkoutViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class StartOneWorkoutByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly WorkoutDataModelProviderGateway $provider,
        private readonly SingleWorkoutViewPresenter $presenter,
        private readonly WorkoutDataModelPersister $persister,
    ) {
    }

    public function execute(int $id, TokenPayloadDTO $payload): SingleObjectViewModel
    {
        $workout = $this->provider->getWorkoutById($id);
        if (null === $workout) {
            throw new NotFoundHttpException("Workout #$id cannot be found");
        }

        if (WorkoutStatusRegistry::WORKOUT_STATUS_COMPLETED === $workout->status) {
            throw new AccessDeniedHttpException("Workout #$id is already completed");
        }

        if (WorkoutStatusRegistry::WORKOUT_STATUS_PLANNED === $workout->status) {
            $workout->startDate = new \DateTimeImmutable();
            $workout->status = WorkoutStatusDataTransformer::computeStatus($workout);

            $this->persister->edit($workout);
        }

        return $this->presenter->present($workout, $payload->userType);
    }
}
