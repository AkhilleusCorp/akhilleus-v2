<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use App\Infrastructure\Repository\CommonWhereFilterTrait;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserDataModelRepository extends AbstractBaseDataModelRepository implements UserDataModelProviderGateway, UserProviderInterface
{
    use CommonWhereFilterTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserDataModel::class);
    }

    protected function getAlias(): string
    {
        return 'user';
    }

    public function getUserById(int $userId): ?UserDataModel
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere('user.id = :userId')
            ->setParameter('userId', $userId)
            ->leftJoin('user.lifecycle', 'user_lifecycle')
            ->addSelect('user_lifecycle')
            ->leftJoin('user.configuration', 'user_configuration')
            ->addSelect('user_configuration')
            ->getQuery()->getOneOrNullResult();
    }

    /**
     * @return UserDataModel[]
     */
    public function getUsersByFilterModel(GetManyUsersFilterModel $filter): array
    {
        return $this->getByFilterModel($filter);
    }

    public function countUsersByFilterModel(?GetManyUsersFilterModel $filter): int
    {
        return $this->countByFilterModel($filter);
    }

    public function addParametersFromFilter(QueryBuilder $queryBuilder, GetManyUsersFilterModel|FilterModelInterface $filter): self
    {
        $this->filterByIds($queryBuilder, $filter->ids);
        $this->filterByStatus($queryBuilder, $filter->status);
        $this->filterByType($queryBuilder, $filter->type);

        if (false === empty($filter->username)) {
            $queryBuilder->andWhere($this->getAlias().'.username LIKE :username')
                ->setParameter('username', '%' . $filter->username . '%');
        }

        if (false === empty($filter->email)) {
            $queryBuilder->andWhere($this->getAlias().'.email LIKE :email')
                ->setParameter('email', '%' . $filter->email . '%');
        }

        return $this;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->getUserById($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        // TODO: Implement supportsClass() method.
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        // TODO: Implement loadUserByIdentifier() method.
    }


}