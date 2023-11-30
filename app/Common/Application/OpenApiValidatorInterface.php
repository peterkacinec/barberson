<?php

declare(strict_types=1);

namespace App\Common\Application;

use App\Common\Infrastructure\OpenApi\OpenApiValidatorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface OpenApiValidatorInterface
{
    /**
     * @throws OpenApiValidatorException
     */
    public function validateRequest(Request $request): void;

    public function validateResponse(Request $request, JsonResponse $response): JsonResponse;
}
