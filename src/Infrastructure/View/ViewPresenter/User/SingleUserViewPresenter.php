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
        $view = new SingleUserViewModel();
        $view->id = $data->id;
        $view->login = $data->login;
        $view->email = $data->email;

        return $view;
    }

    protected function presentForMember(UserDataModel|DataModelInterface $data): SingleUserViewModel
    {
        $view = new SingleUserViewModel();
        $view->id = $data->id;
        $view->login = $data->login;
        $view->email = EmailObfuscationDataTransformer::obfuscate($data->email);

        return $view;
    }
}