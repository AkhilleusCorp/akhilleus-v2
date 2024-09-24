<?php

namespace App\UseCase\User;

use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\User\SingleUserViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneUserByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UserDataModelProviderGateway $provider,
        private readonly SingleUserViewPresenter      $presenter,
    ) {

    }
    public function execute(int $id, string $dataProfile = DataProfileRegistry::DATA_PROFILE_MEMBER): SingleUserViewModel
    {
        $user = $this->provider->getUserById($id);
        if (null === $user) {
            throw new NotFoundHttpException("User #$id cannot be found");
        }

        return $this->presenter->present($user, $dataProfile);
    }
}