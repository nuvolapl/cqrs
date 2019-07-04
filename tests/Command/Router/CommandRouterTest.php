<?php declare(strict_types=1);

namespace Tests\Nuvola\CQRS\Command\Router;

use Nuvola\CQRS\Command\Router\CommandRouter;
use PHPUnit\Framework\TestCase;
use Tests\Nuvola\CQRS\Command\TestCommand;
use Tests\Nuvola\CQRS\CommandHandler\AnotherTestCommandHandler;
use Tests\Nuvola\CQRS\CommandHandler\TestCommandHandler;

class CommandRouterTest extends TestCase
{
    public function testGet(): void
    {
        $router = new CommandRouter();
        $router->configure(TestCommand::class, new TestCommandHandler());
        $router->configure(TestCommand::class, new AnotherTestCommandHandler(), 255);

        $handlerCollection = $router->get(TestCommand::class);

        self::assertInstanceOf(AnotherTestCommandHandler::class, $handlerCollection->current());

        $handlerCollection->next();

        self::assertInstanceOf(TestCommandHandler::class, $handlerCollection->current());
    }
}
