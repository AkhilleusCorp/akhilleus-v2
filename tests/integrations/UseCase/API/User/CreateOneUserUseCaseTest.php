<?php

namespace App\Tests\integrations\UseCase\API\User;

use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\User\CreateOneUserUseCase;

final class CreateOneUserUseCaseTest extends AbstractIntegrationTest
{
    private CreateOneUserUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new CreateOneUserUseCase(
            $this->container->get(CreateUserSourceModelFactory::class),
            $this->container->get(UserDataModelFactory::class),
            $this->container->get(UserDataModelPersisterGateway::class),
            $this->container->get(SingleUserViewPresenter::class),
        );
    }

    public function testCreateOneForAdminDataProfile(): void
    {
        $viewModel = $this->useCase->execute(
            [
                'username' => 'bob',
                'email' => 'bob@fakemail.com',
                'plainPassword' => 'Azerty1234!'
            ],
            DataProfileRegistry::DATA_PROFILE_ADMIN
        );

        $this->assertEquals('bob', $viewModel->username);
        $this->assertEquals('bob@fakemail.com', $viewModel->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_CREATED, $viewModel->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewModel->type);
    }

    public function testCreateOneForMemberDataProfile(): void
    {
        $viewModel = $this->useCase->execute(
            [
                'username' => 'bob2',
                'email' => 'bob2@fakemail.com',
                'plainPassword' => 'Azerty1234!'
            ]
        );

        $this->assertEquals('bob2', $viewModel->username);
        $this->assertEquals('b***@f*******.com', $viewModel->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_CREATED, $viewModel->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewModel->type);
    }
}