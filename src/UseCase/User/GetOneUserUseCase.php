<?php

namespace App\UseCase\User;

use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Infrastructure\View\ViewModel\User\SingleUserViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneUserUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDTOProviderGateway $provider,
        private readonly SingleUserViewPresenter $presenter,
    ) {

    }
    public function execute(int $id, string $dataProfile): SingleUserViewModel
    {
        $user = $this->provider->getUserById($id);
        if (null === $user) {
            throw new NotFoundHttpException("User #$id cannot be found");
        }

        return $this->presenter->present($user, $dataProfile);
    }
}