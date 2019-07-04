<?php declare(strict_types=1);

namespace Tests\Nuvola\CQRS\Query\Router;

use Nuvola\CQRS\Query\Router\QueryRouter;
use PHPUnit\Framework\TestCase;
use Tests\Nuvola\CQRS\Query\AnotherTestQuery;
use Tests\Nuvola\CQRS\Query\TestQuery;
use Tests\Nuvola\CQRS\QueryHandler\AnotherTestQueryHandler;
use Tests\Nuvola\CQRS\QueryHandler\TestQueryHandler;

class QueryRouterTest extends TestCase
{
    public function testGet(): void
    {
        $router = new QueryRouter();
        $router->configure(TestQuery::class, new TestQueryHandler());
        $router->configure(AnotherTestQuery::class, new AnotherTestQueryHandler());

        self::assertInstanceOf(TestQueryHandler::class, $router->get(TestQuery::class));
        self::assertInstanceOf(AnotherTestQueryHandler::class, $router->get(AnotherTestQuery::class));
    }
}
