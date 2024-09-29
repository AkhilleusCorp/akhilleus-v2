<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\DTO\FilterModel\FilterModelInterface;
use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Gateway\Provider\User\UserDataModelProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDataModelRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserDataModelRepository extends AbstractBaseDataModelRepository implements UserDataModelProviderGateway, UserProviderInterface
{
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
    public function getUsersByParameters(GetManyUsersFilterModel $filter): array
    {
        return $this->getByParameters($filter);
    }

    public function countUsersByParameters(?GetManyUsersFilterModel $filter): int
    {
        return $this->countByParameters($filter);
    }

    protected function addParametersFromFilter(QueryBuilder $queryBuilder, GetManyUsersFilterModel|FilterModelInterface $filter): self
    {
        if (false === empty($filter->ids)) {
            $queryBuilder->andWhere('user.id IN (:ids)')
                ->setParameter('ids', $filter->ids);
        }

        if (false === empty($filter->username)) {
            $queryBuilder->andWhere('user.username LIKE :username')
                ->setParameter('username', '%' . $filter->username . '%');
        }

        if (false === empty($filter->email)) {
            $queryBuilder->andWhere('user.email LIKE :email')
                ->setParameter('email', '%' . $filter->email . '%');
        }

        if (false === empty($filter->types)) {
            $queryBuilder->andWhere('user.type IN (:types)')
                ->setParameter('types', $filter->types);
        }

        if (false === empty($filter->statuses)) {
            $queryBuilder->andWhere('user.status IN (:statuses)')
                ->setParameter('statuses', $filter->statuses);
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