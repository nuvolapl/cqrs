<?php declare(strict_types=1);

namespace Nuvola\CQRS;

interface SystemInterface
{
    public function command(object $command): void;

    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function query(object $query);
}
