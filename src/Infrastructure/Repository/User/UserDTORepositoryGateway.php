<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\DTO\User\UserDTO;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class UserDTORepositoryGateway extends ServiceEntityRepository implements UserDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserDTO::class);
    }

    public function getUserById(int $userId): ?UserDTO
    {
        return $this->createQueryBuilder('user')
            ->andWhere('user.id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()->getOneOrNullResult();
    }
}