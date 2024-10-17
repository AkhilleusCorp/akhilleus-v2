<?php

namespace App\Tests\integrations;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

abstract class AbstractIntegrationTest extends KernelTestCase
{
    protected Container $container;

    protected function setUp(): void
    {
        static::bootKernel(['environment' => 'test', 'debug' => false]);

        $this->container = static::getContainer();

        foreach ($this->getCommands() as $cmd) {
            $process = Process::fromShellCommandline($cmd);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        }
    }

    /**
     * @return string[]
     */
    private function getCommands(): array
    {
        return [
            'php bin/console doctrine:database:drop --if-exists --force --env=test',
            'php bin/console doctrine:database:create --env=test',
            'php bin/console doctrine:schema:create -n --env=test',
            'php bin/console doctrine:fixtures:load -n --env=test',
        ];
    }
}
