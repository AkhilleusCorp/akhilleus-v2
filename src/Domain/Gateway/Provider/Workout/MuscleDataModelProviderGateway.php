<?php

namespace App\Domain\Gateway\Provider\Workout;

use App\Domain\DTO\DataModel\Workout\MuscleDataModel;
use App\Domain\Gateway\Provider\GenericDataModelProviderGateway;

/**
 * @method getOneById(int $id): ?MuscleDataModel
 */
interface MuscleDataModelProviderGateway extends GenericDataModelProviderGateway
{
}