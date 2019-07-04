<?php declare(strict_types=1);

namespace Nuvola\CQRS;

use Nuvola\CQRS\Command\CommandBusInterface;
use Nuvola\CQRS\Query\QueryBusInterface;

class System implements SystemInterface
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var QueryBusInterface
     */
    private $queryBus;

    public function __construct(CommandBusInterface $commandBus, QueryBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function command(object $command): void
    {
        $this->commandBus->dispatch($command);
    }

    public function query(object $query)
    {
        return $this->queryBus->dispatch($query);
    }
}
