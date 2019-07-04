<?php declare(strict_types=1);

use Example\Nuvola\CQRS\Command\CreateAccountCommand;
use Example\Nuvola\CQRS\CommandHandler\CreateAccountCommandHandler;
use Example\Nuvola\CQRS\Query\GetAccountByIdQuery;
use Example\Nuvola\CQRS\Query\GetAccountCollectionQuery;
use Example\Nuvola\CQRS\QueryHandler\GetAccountByIdQueryHandler;
use Example\Nuvola\CQRS\QueryHandler\GetAccountCollectionQueryHandler;
use Nuvola\CQRS\Command\CommandBus;
use Nuvola\CQRS\Command\Router\CommandRouterFactory;
use Nuvola\CQRS\Query\QueryBus;
use Nuvola\CQRS\Query\Router\QueryRouterFactory;
use Nuvola\CQRS\System;
use Nuvola\CQRS\Utils\NameResolver\FqcnNameResolver;

define('DATABASE', __DIR__ . '/../var');

require_once __DIR__ . '/../../vendor/autoload.php';

$nameResolver = new FqcnNameResolver();

$commandRouter = (new CommandRouterFactory($nameResolver))->create(
    [
        new CreateAccountCommandHandler(DATABASE),
    ]
);

$queryRouter = (new QueryRouterFactory($nameResolver))->create(
    [
        new GetAccountByIdQueryHandler(DATABASE),
        new GetAccountCollectionQueryHandler(DATABASE),
    ]
);

$system = new System(
    new CommandBus($nameResolver, $commandRouter),
    new QueryBus($nameResolver, $queryRouter)
);

$command = new CreateAccountCommand(
    sprintf('foo-%s', uniqid()),
    (bool)rand(0, 1),
    new DateTimeImmutable()
);

echo 'Creating new random Account... ';

$system->command($command);

echo 'OK' . PHP_EOL;

echo "Show #{$command->getId()} Account:" . PHP_EOL;

var_dump(
    $system->query(new GetAccountByIdQuery($command->getId()))
);

echo PHP_EOL;

$query = new GetAccountCollectionQuery(5, -5);

echo "List {$query->getLimit()} latest Accounts:" . PHP_EOL;

var_dump(
    iterator_to_array($system->query($query))
);
