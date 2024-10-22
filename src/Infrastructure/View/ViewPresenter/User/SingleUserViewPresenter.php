<?php

namespace App\Infrastructure\View\ViewPresenter\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\DataTransformer\EmailObfuscationDataTransformer;
use App\Infrastructure\View\ViewModel\User\SingleUserDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractSingleObjectViewPresenter;

final class SingleUserViewPresenter extends AbstractSingleObjectViewPresenter
{
    /**
     * @param UserDataModel $data
     */
    public function presentViewData(DataModelInterface $data, string $userType): SingleUserDataViewModel
    {
        $viewData = new SingleUserDataViewModel();
        $viewData->id = $data->id;
        $viewData->username = $data->username;
        $viewData->email = $data->email;
        $viewData->type = $data->type;
        $viewData->status = $data->status;

        $viewData->registrationDate = $data->lifecycle->registrationDate;
        $viewData->lastModificationDate = $data->lifecycle->lastModificationDate;
        $viewData->lastLoginDate = $data->lifecycle->lastLoginDate;
        $viewData->lastCompletedWorkoutDate = $data->lifecycle->lastCompletedWorkoutDate;

        $viewData->dateFormat = $data->configuration->dateFormat;
        $viewData->weightUnit = $data->configuration->weightUnit;
        $viewData->distanceUnit = $data->configuration->distanceUnit;
        $viewData->measurementUnit = $data->configuration->measurementUnit;

        if (UserTypeRegistry::USER_TYPE_ADMIN !== $userType) {
            $viewData->email = EmailObfuscationDataTransformer::obfuscate($data->email);
        }

        return $viewData;
    }
}
