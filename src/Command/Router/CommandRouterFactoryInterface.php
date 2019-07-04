<?php declare(strict_types=1);

namespace Nuvola\CQRS\Command\Router;

interface CommandRouterFactoryInterface
{
    public function create(iterable $handlerCollection, int $priority = 0): CommandRouterInterface;
}
