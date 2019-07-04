<?php declare(strict_types=1);

namespace Example\Nuvola\CQRS\CommandHandler;

use Example\Nuvola\CQRS\Command\CreateAccountCommand;
use function file_put_contents;
use function json_encode;
use function sprintf;

class CreateAccountCommandHandler
{
    /**
     * @var string
     */
    private $database;

    public function __construct(string $database)
    {
        $this->database = $database;
    }

    public function __invoke(CreateAccountCommand $command): void
    {
        $data = [
            'id' => $command->getId(),
            'name' => $command->getName(),
            'confirmed' => $command->getConfirmed(),
            'createdAt' => $command->getCreatedAt()->format('c'),
        ];

        file_put_contents(
            sprintf('%s/accounts.data', $this->database),
            sprintf('%s%s', json_encode($data), PHP_EOL),
            FILE_APPEND
        );
    }
}
