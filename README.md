CQRS [![CircleCI](https://circleci.com/gh/nuvolapl/cqrs/tree/master.svg?style=svg)](https://circleci.com/gh/nuvolapl/cqrs/tree/master)
---
CQRS abstraction for your application

# Installation 
```bash
composer req nuvolapl/cqrs
```

# Usage
```php
class AccountController
{
    /**
     * @var SystemInterface
     */
    private $system;

    public function __construct(SystemInterface $system)
    {
        $this->system = $system;
    }

    public function post(array $payload): void
    {
        $command = new CreateAccountCommand(
            $payload['name'],
            $payload['confirmed'],
            new \DateTimeImmutable()
        );

        $this->system->command($command);
    }

    public function get(int $id): Account
    {
        return $this->system->query(
            new GetAccountByIdQuery($id)
        );
    }

    /**
     * {@inheritdoc}
     *
     * @return Account[]
     */
    public function getCollection(array $query): array
    {
        $collection = $this->system->query(
            new GetAccountCollectionQuery(
                $query['limit'],
                $query['offset']
            )
        );

        return \iterator_to_array($collection);
    }
}
```

# Example

- [Basic](/example/public/basic.php) - manual route configuration
- [Magic](/example/public/magic.php) - auto route configuration
