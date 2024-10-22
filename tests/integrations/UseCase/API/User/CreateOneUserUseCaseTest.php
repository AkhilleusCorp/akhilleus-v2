<?php

namespace App\Tests\integrations\UseCase\API\User;

use App\Domain\Factory\DataModelFactory\User\UserDataModelFactory;
use App\Domain\Factory\SourceModelFactory\User\CreateUserSourceModelFactory;
use App\Domain\Gateway\Persister\User\UserDataModelPersisterGateway;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\View\ViewModel\User\SingleUserDataViewModel;
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

    public function testCreateOneForAdmin(): void
    {
        $viewModel = $this->useCase->execute(
            [
                'username' => 'bob',
                'email' => 'bob@fakemail.com',
                'plainPassword' => 'Azerty1234!',
                'userType' => UserTypeRegistry::USER_TYPE_MEMBER,
            ],
            $this->getAdminTokenPayload()
        );

        /** @var SingleUserDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals('bob', $viewData->username);
        $this->assertEquals('bob@fakemail.com', $viewData->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_CREATED, $viewData->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewData->type);
    }

    public function testCreateOneForMember(): void
    {
        $viewModel = $this->useCase->execute(
            [
                'username' => 'bob2',
                'email' => 'bob2@fakemail.com',
                'plainPassword' => 'Azerty1234!',
            ]
        );

        /** @var SingleUserDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals('bob2', $viewData->username);
        $this->assertEquals('b***@f*******.com', $viewData->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_CREATED, $viewData->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewData->type);
    }
}
