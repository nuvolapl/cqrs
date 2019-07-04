<?php declare(strict_types=1);

namespace Nuvola\CQRS\Query;

use InvalidArgumentException;
use Nuvola\CQRS\Query\Router\QueryRouterInterface;
use Nuvola\CQRS\Utils\NameResolver\NameResolverInterface;

class QueryBus implements QueryBusInterface
{
    /**
     * @var NameResolverInterface
     */
    private $nameResolver;

    /**
     * @var QueryRouterInterface
     */
    private $router;

    public function __construct(NameResolverInterface $nameResolver, QueryRouterInterface $router)
    {
        $this->nameResolver = $nameResolver;
        $this->router = $router;
    }

    public function dispatch(object $query)
    {
        try {
            $handler = $this->router->get($this->nameResolver->resolve($query));
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }

        return $handler($query);
    }
}
