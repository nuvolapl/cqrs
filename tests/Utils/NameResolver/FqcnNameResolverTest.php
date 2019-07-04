<?php

namespace Tests\Nuvola\CQRS\Utils\NameResolver;

use Nuvola\CQRS\Utils\NameResolver\FqcnNameResolver;
use PHPUnit\Framework\TestCase;
use Tests\Nuvola\CQRS\Command\TestCommand;
use Tests\Nuvola\CQRS\CommandHandler\TestCommandHandler;
use Tests\Nuvola\CQRS\Query\AnotherTestQuery;
use Tests\Nuvola\CQRS\QueryHandler\AnotherTestQueryHandler;

class FqcnNameResolverTest extends TestCase
{
    public function testResolve(): void
    {
        $resolver = new FqcnNameResolver();

        self::assertEquals('Test', $resolver->resolve(TestCommand::class));
        self::assertEquals('Test', $resolver->resolve(new TestCommandHandler()));

        self::assertEquals('AnotherTest', $resolver->resolve(AnotherTestQuery::class));
        self::assertEquals('AnotherTest', $resolver->resolve(new AnotherTestQueryHandler()));
    }
}
