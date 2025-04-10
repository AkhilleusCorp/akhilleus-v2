<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\DTO\DataModel\DataModelInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
            if (false === $this->isRef($propertyName)) {
                $dataModel->{$propertyName} = $propertyValue;
            }
        }
    }

    /**
     * @param string[] $refs
     *
     * @return ArrayCollection PHPStan is ignored as it has hard time following the typing of generics
     */
    protected function getRefs(array $refs, string $className): Collection // @phpstan-ignore-line
    {
        $collection = new ArrayCollection();
        foreach ($refs as $ref) {
            $collection->add($this->getReference($ref, $className)); // @phpstan-ignore-line
        }

        return $collection;
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
        if (str_ends_with($propertyName, 'Ref') || str_ends_with($propertyName, 'Refs')) {
            return true;
        }

        return false;
    }
}
