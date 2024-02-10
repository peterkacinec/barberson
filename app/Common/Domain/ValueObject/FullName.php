<?php

declare(strict_types=1);

namespace App\Common\Domain\ValueObject;

class FullName
{
    private function __construct(
        private string $firstName,
        private string $surname,
    ) {
    }

    public static function create(string $firstName, string $surname): self
    {
        return new self($firstName, $surname);
    }

    public function __toString(): string
    {
        return "{$this->firstName} {$this->surname}";
    }

    public function toString(): string
    {
        return $this->__toString();
    }
}
