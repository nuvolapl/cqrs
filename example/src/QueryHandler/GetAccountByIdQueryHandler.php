<?php declare(strict_types=1);

namespace Example\Nuvola\CQRS\QueryHandler;

use Example\Nuvola\CQRS\Query\GetAccountByIdQuery;
use function file;
use function json_decode;
use function sprintf;

class GetAccountByIdQueryHandler
{
    /**
     * @var string
     */
    private $database;

    public function __construct(string $database)
    {
        $this->database = $database;
    }

    public function __invoke(GetAccountByIdQuery $query): ?array
    {
        $rows = file(
            sprintf('%s/accounts.data', $this->database),
            FILE_SKIP_EMPTY_LINES
        );

        foreach ($rows as $row) {
            $data = json_decode($row, true);

            if ($query->getId() === $data['id']) {
                return $data;
            }
        }

        return null;
    }
}
