<?php

namespace App\Tests\integrations\UseCase\API\User;

use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\View\ViewModel\User\SingleUserDataViewModel;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\User\FetchOneUserByIdUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class FetchOneUserByIdUseCaseTest extends AbstractIntegrationTest
{
    private FetchOneUserByIdUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new FetchOneUserByIdUseCase(
            $this->container->get(UserDataModelProviderGateway::class),
            $this->container->get(SingleUserViewPresenter::class)
        );
    }

    public function testFetchOneUserForAdmin(): void
    {
        $userId = 1;
        $viewModel = $this->useCase->execute($userId, $this->getAdminTokenPayload());
        /** @var SingleUserDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($userId, $viewData->id);
        $this->assertEquals('ghriim', $viewData->username);
        $this->assertEquals('ghriim@fakemail.com', $viewData->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_ACTIVE, $viewData->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewData->type);
    }

    public function testFetchOneUserForMember(): void
    {
        $userId = 1;
        $viewModel = $this->useCase->execute($userId, $this->getMemberTokenPayload());
        /** @var SingleUserDataViewModel $viewData */
        $viewData = $viewModel->data;

        $this->assertEquals($userId, $viewData->id);
        $this->assertEquals('ghriim', $viewData->username);
        $this->assertEquals('g*****@f*******.com', $viewData->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_ACTIVE, $viewData->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewData->type);
    }

    public function testFetchOneNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('User #666 cannot be found');

        $this->useCase->execute(666, $this->getAdminTokenPayload());
    }
}
