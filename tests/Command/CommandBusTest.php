<?php declare(strict_types=1);

namespace Tests\Nuvola\CQRS\Command;

use ArrayIterator;
use Nuvola\CQRS\Command\CommandBus;
use Nuvola\CQRS\Command\Router\CommandRouterInterface;
use Nuvola\CQRS\Utils\NameResolver\NameResolverInterface;
use PHPUnit\Framework\TestCase;
use Tests\Nuvola\CQRS\CommandHandler\TestCommandHandler;

class CommandBusTest extends TestCase
{
    public function testDispatch()
    {
        $command = new TestCommand();

        $nameResolver = $this->createMock(NameResolverInterface::class);
        $nameResolver
            ->expects(self::once())
            ->method('resolve')
            ->with($command)
            ->willReturn('Test');

        $handler = $this->createMock(TestCommandHandler::class);
        $handler
            ->expects(self::once())
            ->method('__invoke')
            ->with($command);

        $anotherHandler = $this->createMock(TestCommandHandler::class);
        $anotherHandler
            ->expects(self::once())
            ->method('__invoke')
            ->with($command);

        $router = $this->createMock(CommandRouterInterface::class);
        $router
            ->expects(self::once())
            ->method('get')
            ->with('Test')
            ->willReturn(
                new ArrayIterator(
                    [
                        $handler,
                        $anotherHandler,
                    ]
                )
            );

        $bus = new CommandBus($nameResolver, $router);
        $bus->dispatch($command);
    }
}
