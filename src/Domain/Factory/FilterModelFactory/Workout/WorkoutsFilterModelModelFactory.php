<?php

namespace App\Domain\Factory\FilterModelFactory\Workout;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\Workout\GetManyWorkoutsFilterModel;
use App\Domain\Factory\FilterModelFactory\AbstractFilterModelFactory;

final class WorkoutsFilterModelModelFactory extends AbstractFilterModelFactory
{
    public function buildGetManyWorkoutsFilterModel(array $parameters): GetManyWorkoutsFilterModel|FilterModelInterface
    {
        return $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            new GetManyWorkoutsFilterModel()
        );
    }
}