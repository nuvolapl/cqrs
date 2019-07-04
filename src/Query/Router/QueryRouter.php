<?php declare(strict_types=1);

namespace Nuvola\CQRS\Query\Router;

use InvalidArgumentException;
use function get_class;
use function sprintf;

class QueryRouter implements QueryRouterInterface
{
    /**
     * @var array
     */
    private $router;

    public function configure(string $name, object $handler): void
    {
        if (isset($this->router[$name])) {
            throw new InvalidArgumentException(
                sprintf(
                    'Query "%s" is already configured with "%s" handler, "%s" given!',
                    $name,
                    get_class($this->router[$name]),
                    get_class($handler)
                )
            );
        }

        $this->router[$name] = $handler;
    }

    public function get(string $name): object
    {
        if (false === isset($this->router[$name])) {
            throw new InvalidArgumentException(sprintf('Route for "%s" query is not configured!', $name));
        }

        return $this->router[$name];
    }
}
