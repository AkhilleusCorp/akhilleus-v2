<?php

namespace App\UseCase\API\Workout;

use App\Domain\Factory\FilterModelFactory\Workout\WorkoutsFilterModelModelFactory;
use App\Domain\Gateway\Provider\Workout\WorkoutDataModelProviderGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\MultipleWorkoutViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetManyWorkoutUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly WorkoutDataModelProviderGateway $provider,
        private readonly WorkoutsFilterModelModelFactory $filterFactory,
        private readonly MultipleWorkoutViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(
        array $parameters,
        TokenPayloadDTO $tokenPayload,
        string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER,
    ): MultipleObjectViewModel {
        $filter = $this->filterFactory->buildGetManyWorkoutsFilterModel($parameters, $tokenPayload);
        $workouts = $this->provider->getWorkoutsByFilterModel($filter);

        $workoutsCount = count($workouts);
        if ($workoutsCount === $filter->limit || PaginationViewModel::DEFAULT_FIRST_PAGE !== $filter->page) {
            $workoutsCount = $this->provider->countWorkoutsByFilterModel($filter);
        }

        return $this->presenter->present(
            $workouts,
            $dataProfile,
            [
                new PaginationHydrator(
                    $workoutsCount,
                    $filter->page,
                    $filter->limit
                ),
            ]
        );
    }
}
