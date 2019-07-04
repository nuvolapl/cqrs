<?php declare(strict_types=1);

namespace Tests\Nuvola\CQRS\Query\Router;

use Nuvola\CQRS\Query\Router\QueryRouterFactory;
use Nuvola\CQRS\Query\Router\QueryRouterInterface;
use Nuvola\CQRS\Utils\NameResolver\NameResolverInterface;
use PHPUnit\Framework\TestCase;
use Tests\Nuvola\CQRS\QueryHandler\AnotherTestQueryHandler;
use Tests\Nuvola\CQRS\QueryHandler\TestQueryHandler;

class QueryRouterFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $testQueryHandler = new TestQueryHandler();
        $anotherTestQueryHandler = new AnotherTestQueryHandler();

        $nameResolver = $this->createMock(NameResolverInterface::class);
        $nameResolver
            ->expects(self::exactly(2))
            ->method('resolve')
            ->willReturnMap(
                [
                    [$testQueryHandler, 'Test'],
                    [$anotherTestQueryHandler, 'AnotherTest']
                ]
            );

        $router = (new QueryRouterFactory($nameResolver))->create(
            [
                $testQueryHandler,
                $anotherTestQueryHandler,
            ]
        );

        self::assertInstanceOf(QueryRouterInterface::class, $router);
        self::assertInstanceOf(TestQueryHandler::class, $router->get('Test'));
        self::assertInstanceOf(AnotherTestQueryHandler::class, $router->get('AnotherTest'));
    }
}
