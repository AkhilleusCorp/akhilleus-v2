<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\DTO\FilterModel\PaginableFilterInterface;
use App\Domain\DTO\FilterModel\User\GetManyUsersFilterModel;
use App\Domain\DTO\DataModel\User\UserDataModel;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Infrastructure\Repository\AbstractBaseDTORepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserInterface as TUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserDTORepository extends AbstractBaseDTORepository implements UserDTOProviderGateway, UserProviderInterface
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
    public function getUsersByParameters(GetManyUsersFilterModel $filter): array
    {
        $queryBuilder = $this->createQueryBuilder($this->getAlias());

        $this->addParametersFromFilter($queryBuilder, $filter)
             ->addPaginationConditions($queryBuilder, $filter)
             ->addSortConditions($queryBuilder, $filter);

        return $queryBuilder->getQuery()->getResult();
    }

    public function countUsersByParameters(GetManyUsersFilterModel $filter): int
    {
        $queryBuilder = $this->createQueryBuilder($this->getAlias())
                              ->select('COUNT(DISTINCT user.id)');

        $this->addParametersFromFilter($queryBuilder, $filter);

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

    private function addParametersFromFilter(QueryBuilder $queryBuilder, GetManyUsersFilterModel $filter): self
    {
        if (false === empty($filter->id)) {
            $queryBuilder->andWhere('user.id = :id')
                ->setParameter('id', $filter->username);

            return $queryBuilder->getQuery()->getResult();
        }

        if (false === empty($filter->username)) {
            $queryBuilder->andWhere('user.username LIKE :username')
                ->setParameter('username', '%' . $filter->username . '%');
        }

        if (false === empty($filter->email)) {
            $queryBuilder->andWhere('user.email LIKE :email')
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