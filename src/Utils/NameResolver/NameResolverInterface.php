<?php declare(strict_types=1);

namespace Nuvola\CQRS\Utils\NameResolver;

interface NameResolverInterface
{
    /**
     * {@inheritdoc}
     *
     * @param mixed $input
     */
    public function resolve($input): string;
}
