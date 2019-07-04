<?php declare(strict_types=1);

namespace Nuvola\CQRS\Command\Router;

use Nuvola\CQRS\Utils\NameResolver\NameResolverInterface;

class CommandRouterFactory implements CommandRouterFactoryInterface
{
    /**
     * @var NameResolverInterface
     */
    private $nameResolver;

    public function __construct(NameResolverInterface $nameResolver)
    {
        $this->nameResolver = $nameResolver;
    }

    public function create(iterable $handlerCollection, int $priority = 0): CommandRouterInterface
    {
        $router = new CommandRouter();

        foreach ($handlerCollection as $handler) {
            $router->configure($this->nameResolver->resolve($handler), $handler, $priority);
        }

        return $router;
    }
}
