<?php declare(strict_types=1);

namespace Nuvola\CQRS\Command\Router;

use InvalidArgumentException;
use Iterator;
use function krsort;
use function sprintf;

class CommandRouter implements CommandRouterInterface
{
    /**
     * @var array
     */
    private $router;

    public function configure(string $name, object $handler, int $priority = 0): void
    {
        $this->router[$name][$priority][] = $handler;

        $this->sort($name);
    }

    private function sort(string $fqcn): void
    {
        krsort($this->router[$fqcn]);
    }

    public function get(string $name): Iterator
    {
        if (false === isset($this->router[$name])) {
            throw new InvalidArgumentException(sprintf('Route "%s" is not configured!', $name));
        }

        foreach ($this->router[$name] as $handlers) {
            foreach ($handlers as $handler) {
                yield $handler;
            }
        }
    }
}
