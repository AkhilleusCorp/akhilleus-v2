<?php

namespace App\Domain\Factory\FilterModelFactory\Workout;

use App\Domain\DTO\FilterModel\Workout\GetManyWorkoutsFilterModel;
use App\Domain\Factory\FilterModelFactory\AbstractFilterModelFactory;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\DTO\TokenPayloadDTO;

final class WorkoutsFilterModelModelFactory extends AbstractFilterModelFactory
{
    /**
     * @param array<mixed> $parameters
     */
    public function buildGetManyWorkoutsFilterModel(array $parameters, TokenPayloadDTO $tokenPayload): GetManyWorkoutsFilterModel
    {
        $filterModel = new GetManyWorkoutsFilterModel();
        $this->buildFilter(
            $this->purgeNullStringValues($parameters),
            $filterModel
        );

        if (UserTypeRegistry::USER_TYPE_MEMBER === $tokenPayload->userType
            && null === $filterModel->memberId) {
            $filterModel->memberId = $tokenPayload->userId;
        }

        return $filterModel;
    }
}
