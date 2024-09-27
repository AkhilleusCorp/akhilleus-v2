<?php

namespace App\Infrastructure\View\ViewPresenter\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Infrastructure\DataTransformer\DateToStringDataTransformer;
use App\Infrastructure\DataTransformer\EmailObfuscationDataTransformer;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\User\SingleUserViewModel;
use App\Infrastructure\View\ViewPresenter\SingleObjectViewPresenterInterface;

final class SingleUserViewPresenter implements SingleObjectViewPresenterInterface
{
    public function present(UserDataModel|DataModelInterface $data, string $dataProfile): SingleUserViewModel
    {
        $view = new SingleUserViewModel();
        $view->id = $data->id;
        $view->username = $data->username;
        $view->email = $data->email;
        $view->type = $data->type;
        $view->status = $data->status;
        $view->registrationDate = DateToStringDataTransformer::toString($data->lifecycle->registrationDate);
        $view->lastModificationDate = DateToStringDataTransformer::toString($data->lifecycle->lastModificationDate);
        $view->lastLoginDate = DateToStringDataTransformer::toString($data->lifecycle->lastLoginDate);
        $view->lastCompletedWorkoutDate = DateToStringDataTransformer::toString($data->lifecycle->lastCompletedWorkoutDate);

        if (DataProfileRegistry::DATA_PROFILE_ADMIN !== $dataProfile) {
            $view->email = EmailObfuscationDataTransformer::obfuscate($data->email);
        }

        return $view;
    }
}