<?php declare(strict_types=1);

namespace Example\Nuvola\CQRS\QueryHandler;

use Example\Nuvola\CQRS\Query\GetAccountCollectionQuery;
use Traversable;
use function array_slice;
use function file;
use function json_decode;
use function sprintf;

class GetAccountCollectionQueryHandler
{
    /**
     * @var string
     */
    private $database;

    public function __construct(string $database)
    {
        $this->database = $database;
    }

    /**
     * {@inheritdoc}
     *
     * @return array[]
     */
    public function __invoke(GetAccountCollectionQuery $query): Traversable
    {
        $rows = file(
            sprintf('%s/accounts.data', $this->database),
            FILE_SKIP_EMPTY_LINES
        );

        foreach (array_slice($rows, $query->getOffset(), $query->getLimit()) as $row) {
            yield json_decode($row, true);
        }
    }
}
