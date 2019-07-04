<?php declare(strict_types=1);

namespace Example\Nuvola\CQRS\Query;

class GetAccountCollectionQuery
{
    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    public function __construct(int $limit, int $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
