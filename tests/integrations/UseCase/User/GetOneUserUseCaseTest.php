<?php

namespace App\Tests\integrations\UseCase\User;

use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\Exception\InvalidDataProfileException;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewPresenter\User\SingleUserViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\User\GetOneUserUseCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetOneUserUseCaseTest extends AbstractIntegrationTest
{
    private GetOneUserUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetOneUserUseCase(
            $this->container->get(UserDTOProviderGateway::class),
            $this->container->get(SingleUserViewPresenter::class)
        );
    }

    public function testGetOneUserForAdminDataProfile(): void
    {
        $userId = 1;
        $viewModel = $this->useCase->execute($userId, DataProfileRegistry::DATA_PROFILE_ADMIN);

        $this->assertEquals($userId, $viewModel->id);
        $this->assertEquals('ghriim', $viewModel->username);
        $this->assertEquals('ghriim@fakemail.com', $viewModel->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_ACTIVE, $viewModel->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewModel->type);
    }

    public function testGetOneUserForMemberDataProfile(): void
    {
        $userId = 1;
        $viewModel = $this->useCase->execute($userId);

        $this->assertEquals($userId, $viewModel->id);
        $this->assertEquals('ghriim', $viewModel->username);
        $this->assertEquals('g*****@f*******.com', $viewModel->email);
        $this->assertEquals(UserStatusRegistry::USER_STATUS_ACTIVE, $viewModel->status);
        $this->assertEquals(UserTypeRegistry::USER_TYPE_MEMBER, $viewModel->type);
    }

    public function testGetOneUserForUnknownDataProfile(): void
    {
        $this->expectException(InvalidDataProfileException::class);

        $this->useCase->execute(2, 'unknown_data_profile');
    }

    public function testGetOneNonExistingUser(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("User #666 cannot be found");

        $this->useCase->execute(666, DataProfileRegistry::DATA_PROFILE_ADMIN);
    }
}