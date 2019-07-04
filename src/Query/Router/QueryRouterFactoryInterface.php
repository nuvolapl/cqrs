<?php declare(strict_types=1);

namespace Nuvola\CQRS\Query\Router;

interface QueryRouterFactoryInterface
{
    public function create(iterable $handlerCollection): QueryRouterInterface;
}
