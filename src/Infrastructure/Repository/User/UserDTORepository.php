<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\DTO\FilterModel\PaginableFilterInterface;
use App\Domain\DTO\FilterModel\User\UsersFilterModel;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDTORepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class UserDTORepository extends AbstractBaseDTORepository implements UserDTOProviderGateway
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
            ->getQuery()->getOneOrNullResult();
    }

    /**
     * @return UserDataModel[]
     */
    public function getUsersByParameters(UsersFilterModel $filter): array
    {
        $queryBuilder = $this->createQueryBuilder($this->getAlias());

        $this->addParametersFromFilter($queryBuilder, $filter)
             ->addPaginationConditions($queryBuilder, $filter)
             ->addSortConditions($queryBuilder, $filter);

        return $queryBuilder->getQuery()->getResult();
    }

    public function countUsersByParameters(UsersFilterModel $filter): int
    {
        $queryBuilder = $this->createQueryBuilder($this->getAlias())
                              ->select('COUNT(DISTINCT user.id)');

        $this->addParametersFromFilter($queryBuilder, $filter);

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

    private function addParametersFromFilter(QueryBuilder $queryBuilder, UsersFilterModel $filter): self
    {
        if (false === empty($filter->id)) {
            $queryBuilder->andWhere('user.id = :id')
                ->setParameter('id', $filter->login);

            return $queryBuilder->getQuery()->getResult();
        }

        if (false === empty($filter->login)) {
            $queryBuilder->andWhere('user.login LIKE :login')
                ->setParameter('login', '%' . $filter->login . '%');
        }

        if (false === empty($filter->email)) {
            $queryBuilder->andWhere('user.email LIKE :email')
                ->setParameter('email', '%' . $filter->email . '%');
        }

        return $this;
    }
}