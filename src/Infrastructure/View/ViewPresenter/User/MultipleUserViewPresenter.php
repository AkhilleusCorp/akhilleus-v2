<?php

namespace App\Infrastructure\View\ViewPresenter\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Infrastructure\DataTransformer\EmailObfuscationDataTransformer;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\User\MultipleUserItemViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;

final class MultipleUserViewPresenter extends AbstractMultipleObjectViewPresenter
{
    protected function presentItem(UserDataModel|DataModelInterface $data, string $dataProfile): MultipleUserItemViewModel
    {
        $item = new MultipleUserItemViewModel();
        $item->id = $data->id;
        $item->username = $data->username;
        $item->email = $data->email;
        $item->type = $data->type;
        $item->status = $data->status;

        if (DataProfileRegistry::DATA_PROFILE_ADMIN !== $dataProfile) {
            $item->email = EmailObfuscationDataTransformer::obfuscate($data->email);
        }

        return $item;
    }
}