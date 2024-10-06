<?php

namespace App\Domain\Gateway\Provider;

interface DropdownableDataModelProviderGateway
{
    public function getDropdownable(string $labelProperty): array;
}