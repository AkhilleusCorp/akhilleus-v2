<?php

namespace App\Tests\integrations\UseCase\API\User;

use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\User\SingleUserDataViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\User\GetOneUserByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneUserByIdUseCaseTest extends AbstractIntegrationTest
{
    private GetOneUserByIdUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetOneUserByIdUseCase(
            $this->container->get(UserDataModelProviderGateway::class),
            $this->container->get(SingleUserViewPresenter::class)
        );
    }

    public function testGetOneUserForAdminDataProfile(): void
    {
        $userId = 1;
        $viewModel = $this->useCase->execute($userId, DataProfileRegistry::DATA_PROFILE_ADMIN);
        /** @var SingleUserDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($userId, $viewData->id);
        $this->assertEquals('ghriim', $viewData->username);
        $this->assertEquals('ghriim@fakemail.com', $viewData->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_ACTIVE, $viewData->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewData->type);
    }

    public function testGetOneUserForMemberDataProfile(): void
    {
        $userId = 1;
        $viewModel = $this->useCase->execute($userId);
        /** @var SingleUserDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($userId, $viewData->id);
        $this->assertEquals('ghriim', $viewData->username);
        $this->assertEquals('g*****@f*******.com', $viewData->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_ACTIVE, $viewData->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewData->type);
    }

    public function testGetOneNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('User #666 cannot be found');

        $this->useCase->execute(666, DataProfileRegistry::DATA_PROFILE_ADMIN);
    }
}
