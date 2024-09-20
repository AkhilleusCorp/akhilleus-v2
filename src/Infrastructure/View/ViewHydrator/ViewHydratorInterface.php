<?php

namespace App\Infrastructure\View\ViewHydrator;

interface ViewHydratorInterface
{
    public function hydrate(): array;
}