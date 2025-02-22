<?php

namespace App\Tests\integrations\UseCase\API\User;

use App\Domain\DTO\FilterModel\AbstractFilterModel;
use App\Domain\Factory\FilterModelFactory\FilterModelFactory;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Domain\Registry\User\UserStatusRegistry;
use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewModel\User\MultipleUserItemDataViewModel;
use App\Infrastructure\View\ViewPresenter\User\MultipleUserViewPresenter;
use App\Tests\integrations\AbstractIntegrationTest;
use App\UseCase\API\User\FetchManyUsersUseCase;

final class FetchManyUsersUseCaseTest extends AbstractIntegrationTest
{
    private FetchManyUsersUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useCase = new FetchManyUsersUseCase(
            $this->container->get(UserDataModelProviderGateway::class),
            $this->container->get(FilterModelFactory::class),
            $this->container->get(MultipleUserViewPresenter::class)
        );
    }

    public function testFetchManyUserWithNoFiltersForAdmin(): void
    {
        $view = $this->useCase->execute([], $this->getAdminTokenPayload());

        /** @var MultipleUserItemDataViewModel[] $users */
        $users = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(AbstractFilterModel::DEFAULT_LIMIT, $users);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }

    public function testFetchManyUserWithNoFiltersForMember(): void
    {
        $view = $this->useCase->execute([], $this->getMemberTokenPayload());

        /** @var MultipleUserItemDataViewModel[] $users */
        $users = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(AbstractFilterModel::DEFAULT_LIMIT, $users);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(AbstractFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }

    public function testFetchManyUserWithFilterIdsFilter(): void
    {
        $view = $this->useCase->execute(['ids' => [1, 2, 3], 'email' => null], $this->getAdminTokenPayload());
        $this->assertCount(3, $view->data);

        $view = $this->useCase->execute(['ids' => [1, 2, 3]], $this->getMemberTokenPayload());
        $this->assertCount(3, $view->data);
    }

    public function testFetchManyUserWithFilterUsernameFilter(): void
    {
        $view = $this->useCase->execute(['username' => 'ghriim'], $this->getAdminTokenPayload());
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['username' => 'ghriim'], $this->getMemberTokenPayload());
        $this->assertCount(1, $view->data);
    }

    public function testFetchManyUserWithFilterEmailFilter(): void
    {
        $view = $this->useCase->execute(['email' => 'coach@fakemail.com'], $this->getAdminTokenPayload());
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['email' => 'not_an_existing_mail@fakemail.com'], $this->getAdminTokenPayload());
        $this->assertCount(0, $view->data);
    }

    public function testFetchManyUserWithFilterTypesFilter(): void
    {
        $view = $this->useCase->execute(['type' => [UserTypeRegistry::USER_TYPE_ADMIN]], $this->getAdminTokenPayload());
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['type' => [UserTypeRegistry::USER_TYPE_COACH]], $this->getAdminTokenPayload());
        $this->assertCount(1, $view->data);

        $view = $this->useCase->execute(['type' => [UserTypeRegistry::USER_TYPE_MEMBER]], $this->getAdminTokenPayload());
        $this->assertCount(25, $view->data);
    }

    public function testFetchManyUserWithFilterStatusesFilter(): void
    {
        $view = $this->useCase->execute(['status' => [UserStatusRegistry::USER_STATUS_DEACTIVATED]], $this->getAdminTokenPayload());
        $this->assertCount(0, $view->data);

        $view = $this->useCase->execute(['status' => [UserStatusRegistry::USER_STATUS_ACTIVE]], $this->getMemberTokenPayload());
        $this->assertCount(25, $view->data);

        $view = $this->useCase->execute(['status' => [UserStatusRegistry::USER_STATUS_CREATED]], $this->getMemberTokenPayload());
        $this->assertCount(9, $view->data);
    }
}
