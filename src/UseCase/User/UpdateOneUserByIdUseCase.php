<?php

namespace App\UseCase\User;

use App\Domain\Factory\DataModelFactory\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\UpdateUserSourceModelFactory;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Infrastructure\Persister\User\UserDTOPersister;
use App\Infrastructure\View\ViewModel\User\SingleUserViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UpdateOneUserByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UpdateUserSourceModelFactory $sourceModelFactory,
        private readonly UserDataModelFactory $dataModelFactory,
        private readonly UserDTOProviderGateway $provider,
        private readonly UserDTOPersister $persister,
        private readonly SingleUserViewPresenter $presenter,
    ) {

    }
    public function execute(int $id, array $parameters, string $dataProfile): SingleUserViewModel
    {
        $user = $this->provider->getUserById($id);
        if (null === $user) {
            throw new NotFoundHttpException("User #$id cannot be found");
        }

        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        $user = $this->dataModelFactory->mergeSourceAndDataModel($user, $source);

        $this->persister->edit($user);

        return $this->presenter->present($user, $dataProfile);
    }
}