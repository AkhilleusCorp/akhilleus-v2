<?php

namespace App\Domain\Gateway\Provider\Workout;

use App\Domain\DTO\DataModel\Workout\MuscleDataModel;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;

/**
 * @method ?MuscleDataModel fetchOneById(int $id)
 */
interface MuscleDataModelProviderGateway extends GenericDataModelProviderGateway
{
}
