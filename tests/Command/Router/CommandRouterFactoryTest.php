<?php declare(strict_types=1);

namespace Tests\Nuvola\CQRS\Command\Router;

use Nuvola\CQRS\Command\Router\CommandRouterFactory;
use Nuvola\CQRS\Command\Router\CommandRouterInterface;
use Nuvola\CQRS\Utils\NameResolver\NameResolverInterface;
use PHPUnit\Framework\TestCase;
use Tests\Nuvola\CQRS\CommandHandler\AnotherTestCommandHandler;
use Tests\Nuvola\CQRS\CommandHandler\TestCommandHandler;

class CommandRouterFactoryTest extends TestCase
{
    public function testCreate()
    {
        $testCommandHandler = new TestCommandHandler();
        $anotherTestCommandHandler = new AnotherTestCommandHandler();

        $nameResolver = $this->createMock(NameResolverInterface::class);
        $nameResolver
            ->expects(self::exactly(2))
            ->method('resolve')
            ->willReturnMap(
                [
                    [$testCommandHandler, 'Test'],
                    [$anotherTestCommandHandler, 'AnotherTest']
                ]
            );

        $router = (new CommandRouterFactory($nameResolver))->create(
            [
                $testCommandHandler,
                $anotherTestCommandHandler,
            ]
        );

        self::assertInstanceOf(CommandRouterInterface::class, $router);
        self::assertInstanceOf(TestCommandHandler::class, $router->get('Test')->current());
        self::assertInstanceOf(AnotherTestCommandHandler::class, $router->get('AnotherTest')->current());
    }
}
