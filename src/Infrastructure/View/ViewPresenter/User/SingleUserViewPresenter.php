<?php

namespace App\Infrastructure\View\ViewPresenter\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Infrastructure\DataTransformer\EmailObfuscationDataTransformer;
use App\Infrastructure\View\ViewModel\User\SingleUserViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractSingleObjectViewPresenter;

final class SingleUserViewPresenter extends AbstractSingleObjectViewPresenter
{
    protected function presentForAdmin(UserDataModel|DataModelInterface $data): SingleUserViewModel
    {
        $view = $this->presentCommonData($data);
        $view->email = $data->email;
        $view->type = $data->type;
        $view->status = $data->status;

        return $view;
    }

    protected function presentForMember(UserDataModel|DataModelInterface $data): SingleUserViewModel
    {
        $view = $this->presentCommonData($data);
        $view->email = EmailObfuscationDataTransformer::obfuscate($data->email);

        return $view;
    }

    private function presentCommonData(UserDataModel $data): SingleUserViewModel
    {
        $view = new SingleUserViewModel();
        $view->id = $data->id;
        $view->username = $data->username;

        return $view;
    }
}