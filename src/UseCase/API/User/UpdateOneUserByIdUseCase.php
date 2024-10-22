<?php

namespace App\UseCase\API\User;

use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\UpdateUserSourceModelFactory;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Infrastructure\DTO\TokenPayloadDTO;
use App\Infrastructure\Persister\User\UserDataModelPersister;
use App\Infrastructure\View\ViewModel\SingleObjectViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UpdateOneUserByIdUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly UpdateUserSourceModelFactory $sourceModelFactory,
        private readonly UserDataModelFactory $dataModelFactory,
        private readonly UserDataModelProviderGateway $provider,
        private readonly UserDataModelPersister $persister,
        private readonly SingleUserViewPresenter $presenter,
    ) {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function execute(int $id, array $parameters, TokenPayloadDTO $payload): SingleObjectViewModel
    {
        $user = $this->provider->getUserById($id);
        if (null === $user) {
            throw new NotFoundHttpException("User #$id cannot be found");
        }

        $source = $this->sourceModelFactory->buildSourceModel($parameters);
        $user = $this->dataModelFactory->mergeSourceAndDataModel($user, $source);

        $this->persister->edit($user);

        return $this->presenter->present($user, $payload->userType);
    }
}
