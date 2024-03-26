<?php

declare(strict_types=1);

namespace App\Common\Domain\ValueObject;

use InvalidArgumentException;

class FullName
{
    private function __construct(
        private string $firstName,
        private string $surname,
    ) {
    }

    public static function create(string $firstName, string $surname): self
    {
        if (strlen(trim($firstName)) === 0 || strlen(trim($surname)) === 0) {
            throw new InvalidArgumentException(
                "Value [$firstName $surname] is not supported full name"
            );
        }

        return new self($firstName, $surname);
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return "$this->firstName $this->surname";
    }
}
