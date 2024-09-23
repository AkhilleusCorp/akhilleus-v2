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

        $process = new Process(['make', 'reset_test_db']);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}