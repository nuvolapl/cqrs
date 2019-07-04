<?php declare(strict_types=1);

namespace Tests\Nuvola\CQRS\CommandHandler;

use Tests\Nuvola\CQRS\Command\TestCommand;

class AnotherTestCommandHandler
{
    public function __invoke(TestCommand $command): void
    {
    }
}
