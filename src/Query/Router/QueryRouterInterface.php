<?php declare(strict_types=1);

namespace Nuvola\CQRS\Query\Router;

interface QueryRouterInterface
{
    public function configure(string $name, object $handler): void;

    /**
     * {@inheritdoc}
     *
     * @return object
     */
    public function get(string $name): object;
}
