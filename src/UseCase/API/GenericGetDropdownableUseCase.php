<?php

namespace App\UseCase\API;

use App\Domain\Gateway\Provider\DropdownableDataModelProviderGateway;

final class GenericGetDropdownableUseCase
{
    /**
     * @return array<string, string>
     */
    public function execute(string $labelProperty, DropdownableDataModelProviderGateway $providerGateway): array
    {
        $results = $providerGateway->getDropdownable($labelProperty);

        $dropdownableList = [];
        foreach ($results as $result) {
            $dropdownableList[$result['id']] = $result['label'];
        }

        return $dropdownableList;
    }
}
