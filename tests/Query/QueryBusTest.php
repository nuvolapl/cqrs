<?php declare(strict_types=1);

namespace Tests\Nuvola\CQRS\Query;

use Nuvola\CQRS\Query\QueryBus;
use Nuvola\CQRS\Query\Router\QueryRouterInterface;
use Nuvola\CQRS\Utils\NameResolver\NameResolverInterface;
use PHPUnit\Framework\TestCase;
use Tests\Nuvola\CQRS\QueryHandler\TestQueryHandler;

class QueryBusTest extends TestCase
{
    public function testDispatch(): void
    {
        $query = new TestQuery();

        $nameResolver = $this->createMock(NameResolverInterface::class);
        $nameResolver
            ->expects(self::once())
            ->method('resolve')
            ->with($query)
            ->willReturn('Test');

        $handler = $this->createMock(TestQueryHandler::class);
        $handler
            ->expects(self::once())
            ->method('__invoke')
            ->with($query)
            ->willReturn(['foo']);

        $router = $this->createMock(QueryRouterInterface::class);
        $router
            ->expects(self::once())
            ->method('get')
            ->with('Test')
            ->willReturn($handler);

        $result = (new QueryBus($nameResolver, $router))->dispatch($query);

        self::assertIsArray($result);
        self::assertEquals(['foo'], $result);
    }
}
