<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\OpenApi;

use RuntimeException;
use Throwable;

class OpenApiValidatorException extends RuntimeException
{
    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct('Open API validation failed: ' . $message, 0, $previous);
    }
}
