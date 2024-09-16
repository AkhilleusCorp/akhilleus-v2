<?php

namespace App\Infrastructure\Persister;

use App\Domain\DTO\DataModel\DataModelInterface;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractDTOPersister
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }

    public function save(DataModelInterface $dto, bool $flush = true): DataModelInterface
    {
        $this->entityManager->persist($dto);

        if(true === $flush) {
            $this->entityManager->flush();
        }

        return $dto;
    }

    public function delete(DataModelInterface $dto, bool $flush = true): void
    {
        $this->entityManager->remove($dto);

        if(true === $flush) {
            $this->entityManager->flush();
        }
    }
}