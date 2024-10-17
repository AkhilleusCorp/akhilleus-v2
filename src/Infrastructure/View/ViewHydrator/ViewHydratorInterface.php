<?php

namespace App\Infrastructure\View\ViewHydrator;

interface ViewHydratorInterface
{
    /**
     * @return array<mixed>
     */
    public function hydrate(): array;
}
