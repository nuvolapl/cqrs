<?php declare(strict_types=1);

namespace Nuvola\CQRS\Command;

interface CommandBusInterface
{
    public function dispatch(object $command): void;
}
