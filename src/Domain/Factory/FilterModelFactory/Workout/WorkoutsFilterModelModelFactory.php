<?php

namespace App\Domain\Factory\FilterModelFactory\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyWorkoutsFilterModel;
use App\Domain\Factory\FilterModelFactory\AbstractFilterModelFactory;

final class WorkoutsFilterModelModelFactory extends AbstractFilterModelFactory
{
    /**
     * @param array<mixed> $parameters
     */
    public function buildGetManyWorkoutsFilterModel(array $parameters): GetManyWorkoutsFilterModel
    {
        $filterModel = new GetManyWorkoutsFilterModel();
        $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            $filterModel
        );

        return $filterModel;
    }
}
