<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\DTO\DataModel\DataModelInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

abstract class AbstractFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->explicitFixtures($manager);
        $this->volumeFixtures($manager);

        $manager->flush();
    }

    abstract protected function explicitFixtures(ObjectManager $manager): void;

    abstract protected function volumeFixtures(ObjectManager $manager): void;

    /**
     * @param mixed[] $properties
     */
    protected function setProperties(DataModelInterface $dataModel, array $properties): void
    {
        foreach ($properties as $propertyName => $propertyValue) {
            if (true === $this->isRef($propertyName)) {
                $propertyName = str_replace('Ref', '', $propertyName);
                $dataModel->{$propertyName} = $this->getReference($propertyValue);

                continue;
            }

            if (true === $this->isRefs($propertyName) && true === is_array($propertyValue)) {
                $propertyName = str_replace('Refs', '', $propertyName);
                foreach ($propertyValue as $value) {
                    $dataModel->{$propertyName}->add($this->getReference($value));
                }

                continue;
            }

            $dataModel->{$propertyName} = $propertyValue;
        }
    }

    protected function addRef(string $prefix, string $text, DataModelInterface $object): void
    {
        $ref = str_replace(' ', '-', $text);
        $ref = str_replace('(', '', $ref);
        $ref = str_replace(')', '', $ref);
        $ref = strtolower($ref);

        $this->addReference("{$prefix}-{$ref}", $object);
    }

    private function isRef(string $propertyName): bool
    {
        if (str_ends_with($propertyName, 'Ref')) {
            return true;
        }

        return false;
    }

    private function isRefs(string $propertyName): bool
    {
        if (str_ends_with($propertyName, 'Refs')) {
            return true;
        }

        return false;
    }
}
