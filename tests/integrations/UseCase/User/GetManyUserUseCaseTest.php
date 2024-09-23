<?php

namespace App\Tests\integrations\UseCase\User;

use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\Factory\FilterModelFactory\User\UsersFilterModelModelFactory;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Infrastructure\Exception\InvalidDataProfileException;
use App\Infrastructure\Registry\DataProfileRegistry;
use App\Infrastructure\View\ViewModel\PaginationViewModel;
use App\Infrastructure\View\ViewModel\User\MultipleUserItemViewModel;
use App\Infrastructure\View\ViewPresenter\User\MultipleUserViewPresenter;
use App\UseCase\User\GetManyUserUseCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class GetManyUserUseCaseTest extends KernelTestCase
{
    private GetManyUserUseCase $useCase;

    protected function setUp(): void
    {
        static::bootKernel(['environment' => 'test', 'debug' => false]);

        $container = static::getContainer();
        $this->useCase = new GetManyUserUseCase(
            $container->get(UserDTOProviderGateway::class),
            $container->get(UsersFilterModelModelFactory::class),
            $container->get(MultipleUserViewPresenter::class)
        );
    }

    public function testGetManyUserWithNoFiltersForAdminDataProfile(): void
    {
        $view = $this->useCase->execute([], DataProfileRegistry::DATA_PROFILE_ADMIN);

        /** @var MultipleUserItemViewModel[] $users */
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
        $view = $this->useCase->execute([], DataProfileRegistry::DATA_PROFILE_MEMBER);

        /** @var MultipleUserItemViewModel[] $users */
        $users = $view->data;
        /** @var PaginationViewModel $pagination */
        $pagination = $view->extra['pagination'];

        $this->assertCount(GetManyUsersFilterModel::DEFAULT_LIMIT, $users);
        $this->assertEquals(GetManyUsersFilterModel::DEFAULT_PAGE, $pagination->firstPage);
        $this->assertEquals(GetManyUsersFilterModel::DEFAULT_PAGE, $pagination->currentPage);
        $this->assertEquals(3, $pagination->lastPage);
    }

    public function testGetManyUserWithNoFiltersForUnknownDataProfile(): void
    {
        $this->expectException(InvalidDataProfileException::class);

        $this->useCase->execute([], 'unknown_data_profile');
    }
}