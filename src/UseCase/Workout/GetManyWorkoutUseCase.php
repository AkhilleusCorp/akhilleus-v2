<?php

namespace App\UseCase\Workout;

use App\Domain\Factory\FilterModelFactory\Workout\WorkoutsFilterModelModelFactory;
use App\Domain\Gateway\Provider\Workout\WorkoutDTOProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewHydrator\PaginationHydrator;
use App\Infrastructure\View\ViewModel\MultipleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\Workout\MultipleWorkoutViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetManyWorkoutUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly WorkoutDTOProviderGateway $provider,
        private readonly WorkoutsFilterModelModelFactory $filterFactory,
        private readonly MultipleWorkoutViewPresenter $presenter,
    ) {

    }

    public function execute(array $parameters, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): MultipleObjectViewModel
    {

        $filter = $this->filterFactory->buildGetManyWorkoutsFilterModel($parameters);
        $workouts = $this->provider->getWorkoutsByParameters($filter);

        $workoutsCount = count($workouts);
        if ($workoutsCount === $filter->limit) {
            $workoutsCount = $this->provider->countWorkoutsByParameters($filter);
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