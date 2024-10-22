<?php

namespace App\Infrastructure\View\ViewPresenter\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\DataTransformer\EmailObfuscationDataTransformer;
use App\Infrastructure\View\ViewModel\User\MultipleUserItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\AbstractMultipleObjectViewPresenter;

final class MultipleUserViewPresenter extends AbstractMultipleObjectViewPresenter
{
    /**
     * @param UserDataModel $data
     */
    public function presentItem(DataModelInterface $data, ?string $userType): MultipleUserItemDataViewModel
    {
        $item = new MultipleUserItemDataViewModel();
        $item->id = $data->id;
        $item->username = $data->username;
        $item->email = $data->email;
        $item->type = $data->type;
        $item->status = $data->status;

        if (UserTypeRegistry::USER_TYPE_ADMIN !== $userType) {
            $item->email = EmailObfuscationDataTransformer::obfuscate($data->email);
        }

        return $item;
    }
}
