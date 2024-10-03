<?php

namespace App\Infrastructure\Persister;

use App\Domain\DTO\DataModel\DataModelInterface;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractEntityPersister
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {

    }

    protected function save(DataModelInterface $dto, bool $flush = true): DataModelInterface
    {
        $this->entityManager->persist($dto);

        if(true === $flush) {
            $this->entityManager->flush();
        }

        return $dto;
    }

    protected function delete(DataModelInterface $dto, bool $flush = true): void
    {
        $this->entityManager->remove($dto);

        if(true === $flush) {
            $this->entityManager->flush();
        }
    }
}