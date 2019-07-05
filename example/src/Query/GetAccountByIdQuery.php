<?php declare(strict_types=1);

namespace Example\Nuvola\CQRS\Query;

class GetAccountByIdQuery
{
    /**
     * @var int
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
