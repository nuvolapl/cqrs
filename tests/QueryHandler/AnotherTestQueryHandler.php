<?php declare(strict_types=1);

namespace Tests\Nuvola\CQRS\QueryHandler;

use Tests\Nuvola\CQRS\Query\TestQuery;

class AnotherTestQueryHandler
{
    public function __invoke(TestQuery $query): array
    {
        return [];
    }
}
