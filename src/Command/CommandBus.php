<?php declare(strict_types=1);

namespace Nuvola\CQRS\Command;

use InvalidArgumentException;
use Nuvola\CQRS\Command\Router\CommandRouterInterface;
use Nuvola\CQRS\Utils\NameResolver\NameResolverInterface;

class CommandBus implements CommandBusInterface
{
    /**
     * @var NameResolverInterface
     */
    private $nameResolver;

    /**
     * @var CommandRouterInterface
     */
    private $router;

    public function __construct(NameResolverInterface $nameResolver, CommandRouterInterface $router)
    {
        $this->nameResolver = $nameResolver;
        $this->router = $router;
    }

    public function dispatch(object $command): void
    {
        try {
            $handlerCollection = $this->router->get($this->nameResolver->resolve($command));
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }

        foreach ($handlerCollection as $handler) {
            $handler($command);
        }
    }
}
