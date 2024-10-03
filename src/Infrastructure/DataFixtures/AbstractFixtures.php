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

    protected abstract function explicitFixtures(ObjectManager $manager): void;

    protected abstract function volumeFixtures(ObjectManager $manager): void;

    protected function addRef(string $prefix, string $text, DataModelInterface $object): void
    {
        $ref = str_replace(" ", "-", $text);
        $ref = str_replace("(", "", $ref);
        $ref = str_replace(")", "", $ref);
        $ref = strtolower($ref);

        $this->addReference("{$prefix}-{$ref}", $object);
    }

}