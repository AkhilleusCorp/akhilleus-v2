<?php

namespace App\Domain\Factory\FilterModelFactory\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyMovementsFilterModel;
use App\Domain\Factory\FilterModelFactory\AbstractFilterModelFactory;

final class MovementsFilterModelModelFactory extends AbstractFilterModelFactory
{
    /**
     * @param array<mixed> $parameters
     */
    public function buildGetManyMovementsFilterModel(array $parameters): GetManyMovementsFilterModel
    {
        $filterModel = new GetManyMovementsFilterModel();
        $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            $filterModel
        );

        return $filterModel;
    }
}
