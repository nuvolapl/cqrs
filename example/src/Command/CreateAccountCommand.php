<?php declare(strict_types=1);

namespace Example\Nuvola\CQRS\Command;

use DateTimeImmutable;

class CreateAccountCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $confirmed;

    /**
     * @var DateTimeImmutable
     */
    private $createdAt;

    public function __construct(string $name, bool $confirmed, DateTimeImmutable $createdAt)
    {
        $this->id = rand();
        $this->name = $name;
        $this->confirmed = $confirmed;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getConfirmed(): bool
    {
        return $this->confirmed;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
