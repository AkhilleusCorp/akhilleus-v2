<?php

namespace App\Tests\integrations\UseCase\API\User;

use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\Factory\FilterModelFactory\User\UsersFilterModelModelFactory;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewModel\User\MultipleUserItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\User\MultipleUserViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\User\GetManyUserUseCase;

final class GetManyUserUseCaseTest extends AbstractIntegrationTest
{
    private GetManyUserUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new GetManyUserUseCase(
            $this->container->get(UserDataModelProviderGateway::class),
            $this->container->get(UsersFilterModelModelFactory::class),
            $this->container->get(MultipleUserViewPresenter::class)
        );
    }

    public function testGetManyUserWithNoFiltersForAdminDataProfile(): void
    {
        $view = $this->useCase->execute([], DataProfileRegistry::DATA_PROFILE_ADMIN);

        /** @var MultipleUserItemDataViewModel[] $users */
        $users = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(GetManyUsersFilterModel::DEFAULT_LIMIT, $users);
        $this->assertEquals(GetManyUsersFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(GetManyUsersFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }

    public function testGetManyUserWithNoFiltersForMemberDataProfile(): void
    {
        $view = $this->useCase->execute([]);

        /** @var MultipleUserItemDataViewModel[] $users */
        $users = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(GetManyUsersFilterModel::DEFAULT_LIMIT, $users);
        $this->assertEquals(GetManyUsersFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(GetManyUsersFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }

    public function testGetManyUserWithFilterIdsFilter(): void
    {
        $view = $this->useCase->execute(['ids' => '1,2,3', 'email' => 'null'], DataProfileRegistry::DATA_PROFILE_ADMIN);
        $this->assertCount(3, $view->data);

        $view = $this->useCase->execute(['ids' => '1,2,3']);
        $this->assertCount(3, $view->data);
    }

    public function testGetManyUserWithFilterUsernameFilter(): void
    {
        $view = $this->useCase->execute(['username' => 'ghriim'], DataProfileRegistry::DATA_PROFILE_ADMIN);
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['username' => 'ghriim']);
        $this->assertCount(1, $view->data);
    }

    public function testGetManyUserWithFilterEmailFilter(): void
    {
        $view = $this->useCase->execute(['email' => 'coach@fakemail.com'], DataProfileRegistry::DATA_PROFILE_ADMIN);
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['email' => 'not_an_existing_mail@fakemail.com'], DataProfileRegistry::DATA_PROFILE_ADMIN);
        $this->assertCount(0, $view->data);
    }

    public function testGetManyUserWithFilterTypesFilter(): void
    {
        $view = $this->useCase->execute(['type' => UserTypeRegistry::USER_TYPE_ADMIN], DataProfileRegistry::DATA_PROFILE_ADMIN);
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['type' => UserTypeRegistry::USER_TYPE_COACH], DataProfileRegistry::DATA_PROFILE_ADMIN);
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['type' => UserTypeRegistry::USER_TYPE_MEMBER], DataProfileRegistry::DATA_PROFILE_ADMIN);
        $this->assertCount(25, $view->data);
    }

    public function testGetManyUserWithFilterStatusesFilter(): void
    {
        $view = $this->useCase->execute(['status' => UserStatusRegistry::USER_STATUS_DEACTIVATED], DataProfileRegistry::DATA_PROFILE_ADMIN);
        $this->assertCount(0, $view->data);

        $view = $this->useCase->execute(['status' => UserStatusRegistry::USER_STATUS_ACTIVE]);
        $this->assertCount(25, $view->data);

        $view = $this->useCase->execute(['status' => UserStatusRegistry::USER_STATUS_CREATED]);
        $this->assertCount(9, $view->data);
    }
}
