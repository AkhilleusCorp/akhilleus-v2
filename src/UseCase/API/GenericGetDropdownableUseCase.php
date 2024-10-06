<?php

namespace App\UseCase\API;

use App\Domain\Gateway\Provider\DropdownableDataModelProviderGateway;

final class GenericGetDropdownableUseCase
{
    /**
     * @param string $labelProperty
     * @param DropdownableDataModelProviderGateway $providerGateway
     *
     * @return array
     */
    public function execute(string $labelProperty, DropdownableDataModelProviderGateway $providerGateway): array
    {
        $results = $providerGateway->getDropdownable($labelProperty);

        $dropdownableList = [];
        foreach ($results as $result) {
            if (false === isset($result[$labelProperty])) {
                throw new \LogicException("{$labelProperty} does not exist on this object");
            }

            $dropdownableList[$result['id']] = $result[$labelProperty];
        }

        return $dropdownableList;
    }
}