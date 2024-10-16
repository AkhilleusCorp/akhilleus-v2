<?php

namespace App\Domain\Gateway\Provider\Workout;

use App\Domain\DTO\DataModel\Workout\MuscleDataModel;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;

/**
 * @method ?MuscleDataModel getOneById(int $id)
 */
interface MuscleDataModelProviderGateway extends GenericDataModelProviderGateway
{
}
