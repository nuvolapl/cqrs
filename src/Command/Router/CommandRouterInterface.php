<?php declare(strict_types=1);

namespace Nuvola\CQRS\Command\Router;

use Iterator;

interface CommandRouterInterface
{
    public function configure(string $name, object $handler, int $priority = 0): void;

    /**
     * {@inheritdoc}
     *
     * @return object[]
     */
    public function get(string $name): Iterator;
}
