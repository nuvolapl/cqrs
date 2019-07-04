<?php declare(strict_types=1);

namespace Tests\Nuvola\CQRS;

use Nuvola\CQRS\Command\CommandBusInterface;
use Nuvola\CQRS\Query\QueryBusInterface;
use Nuvola\CQRS\System;
use PHPUnit\Framework\TestCase;
use Tests\Nuvola\CQRS\Command\TestCommand;
use Tests\Nuvola\CQRS\Query\TestQuery;

class SystemTest extends TestCase
{
    public function testCommand(): void
    {
        $command = new TestCommand();

        $bus = $this->createMock(CommandBusInterface::class);
        $bus
            ->expects(self::once())
            ->method('dispatch')
            ->with($command);

        $system = new System(
            $bus,
            $this->createMock(QueryBusInterface::class)
        );

        $system->command($command);
    }

    public function testQuery(): void
    {
        $query = new TestQuery();

        $bus = $this->createMock(QueryBusInterface::class);
        $bus
            ->expects(self::once())
            ->method('dispatch')
            ->with($query);

        $system = new System(
            $this->createMock(CommandBusInterface::class),
            $bus
        );

        $system->query($query);
    }
}
