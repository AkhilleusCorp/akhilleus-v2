<?php

namespace App\Domain\Gateway\Provider;

interface DropdownableDataModelProviderGateway
{
    /**
     * @return array<mixed>
     */
    public function getDropdownable(string $labelProperty): array;
}
