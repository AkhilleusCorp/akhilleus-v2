<?php

namespace App\Infrastructure\DataFixtures;

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

}