<?php

namespace App\Infrastructure\View\ViewPresenter\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Infrastructure\DataTransformer\EmailObfuscationDataTransformer;
use App\Infrastructure\View\ViewModel\User\MultipleUserItemViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;

final class MultipleUserViewPresenter extends AbstractMultipleObjectViewPresenter
{
    protected function presentForAdmin(UserDataModel|DataModelInterface $data): MultipleUserItemViewModel
    {
        $item = $this->presentCommonData($data);
        $item->email = $data->email;
        $item->type = $data->type;

        return $item;
    }

    protected function presentForMember(UserDataModel|DataModelInterface $data): MultipleUserItemViewModel
    {
        $item = $this->presentCommonData($data);
        $item->email = EmailObfuscationDataTransformer::obfuscate($data->email);

        return $item;
    }

    private function presentCommonData(UserDataModel $data): MultipleUserItemViewModel
    {
        $item = new MultipleUserItemViewModel();
        $item->id = $data->id;
        $item->username = $data->username;

        return $item;
    }
}