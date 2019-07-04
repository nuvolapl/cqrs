<?php declare(strict_types=1);

namespace Nuvola\CQRS\Query\Router;

use Nuvola\CQRS\Utils\NameResolver\NameResolverInterface;

class QueryRouterFactory implements QueryRouterFactoryInterface
{
    /**
     * @var NameResolverInterface
     */
    private $nameResolver;

    public function __construct(NameResolverInterface $nameResolver)
    {
        $this->nameResolver = $nameResolver;
    }

    public function create(iterable $handlerCollection): QueryRouterInterface
    {
        $router = new QueryRouter();

        foreach ($handlerCollection as $handler) {
            $router->configure($this->nameResolver->resolve($handler), $handler);
        }

        return $router;
    }
}
