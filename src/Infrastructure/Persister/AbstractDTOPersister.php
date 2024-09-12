<?php

namespace App\Infrastructure\Persister;

use App\Domain\DTO\DTOInterface;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractDTOPersister
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }

    public function save(DTOInterface $dto, bool $flush = true): DTOInterface
    {
        $this->entityManager->persist($dto);

        if(true === $flush) {
            $this->entityManager->flush();
        }
    }

    public function delete(DTOInterface $dto, bool $flush = true): void
    {
        $this->entityManager->remove($dto);

        if(true === $flush) {
            $this->entityManager->flush();
        }
    }
}