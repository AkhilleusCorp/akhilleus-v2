<?php

namespace App\Tests\integrations;

use App\Domain\Registry\User\UserTypeRegistry;
use App\Infrastructure\DTO\TokenPayloadDTO;
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

    protected function getMemberTokenPayload(): TokenPayloadDTO
    {
        $payload = new TokenPayloadDTO();
        $payload->userId = 3;
        $payload->userType = UserTypeRegistry::USER_TYPE_MEMBER;

        return $payload;
    }

    protected function getCoachTokenPayload(): TokenPayloadDTO
    {
        $payload = new TokenPayloadDTO();
        $payload->userId = 2;
        $payload->userType = UserTypeRegistry::USER_TYPE_COACH;

        return $payload;
    }

    protected function getAdminTokenPayload(): TokenPayloadDTO
    {
        $payload = new TokenPayloadDTO();
        $payload->userId = 1;
        $payload->userType = UserTypeRegistry::USER_TYPE_ADMIN;

        return $payload;
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
