<?php declare(strict_types=1);

namespace Nuvola\CQRS\Query;

interface QueryBusInterface
{
    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function dispatch(object $query);
}
