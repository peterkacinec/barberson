<?php

declare(strict_types=1);

namespace App\Common\Application;

use App\Common\Infrastructure\OpenApi\OpenApiValidatorException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface OpenApiValidatorInterface
{
    /**
     * @throws OpenApiValidatorException
     */
    public function validateRequest(Request $request): void;

    public function validateResponse(Request $request, Response $response): void;
}
