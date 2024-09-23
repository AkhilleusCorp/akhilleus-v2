<?php

namespace App\Tests\integrations\UseCase\User;

use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\UpdateUserSourceModelFactory;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Infrastructure\Persister\User\UserDTOPersister;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\Repository\User\UserDTORepository;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\User\UpdateOneUserByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UpdateOneUserByIdUseCaseTest extends AbstractIntegrationTest
{
    private UpdateOneUserByIdUseCase $useCase;
    private UserDTORepository $userDTORepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCase = new UpdateOneUserByIdUseCase(
            $this->container->get(UpdateUserSourceModelFactory::class),
            $this->container->get(UserDataModelFactory::class),
            $this->container->get(UserDTOProviderGateway::class),
            $this->container->get(UserDTOPersister::class),
            $this->container->get(SingleUserViewPresenter::class),
        );

        $this->userDTORepository = $this->container->get(UserDTORepository::class);
    }

    public function testUpdateExistingUser(): void
    {
        $userId = 1;

        $userPreUpdate = $this->userDTORepository->getUserById($userId);
        $userReplied = $this->useCase->execute(
            $userId,
            ['username' => 'Ghriim-v2', 'email' => 'ghriim-v2@fakemail.com'],
            DataProfileRegistry::DATA_PROFILE_ADMIN
        );
        $userPostUpdate = $this->userDTORepository->getUserById($userId);

        $this->assertEquals($userPostUpdate->username, $userReplied->username);
        $this->assertEquals($userPostUpdate->email, $userReplied->email);
        $this->assertEquals($userPreUpdate->status, $userReplied->status);
    }

    public function testUpdateNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->useCase->execute(666, ['username' => 'bob', 'status' => UserStatusRegistry::USER_STATUS_DEACTIVATED]);
    }
}