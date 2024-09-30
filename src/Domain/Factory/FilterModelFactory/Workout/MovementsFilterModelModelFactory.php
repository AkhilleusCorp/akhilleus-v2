<?php

namespace App\Domain\Factory\FilterModelFactory\Workout;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\Workout\GetManyMovementsFilterModel;
use App\Domain\Factory\FilterModelFactory\AbstractFilterModelFactory;

final class MovementsFilterModelModelFactory extends AbstractFilterModelFactory
{
    public function buildGetManyMovementsFilterModel(array $parameters): GetManyMovementsFilterModel|FilterModelInterface
    {
        return $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            new GetManyMovementsFilterModel()
        );
    }
}