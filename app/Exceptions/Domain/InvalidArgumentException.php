<?php

declare(strict_types=1);

namespace App\Exceptions\Domain;

use App\Exceptions\DomainException;

class InvalidArgumentException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 0, null);
    }
}
