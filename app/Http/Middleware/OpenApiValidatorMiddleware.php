<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Common\Application\OpenApiValidatorInterface;
use App\Common\Infrastructure\OpenApi\OpenApiValidatorException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OpenApiValidatorMiddleware
{
    public function __construct(private OpenApiValidatorInterface $openApiValidator)
    {}

    public function handle(Request $request, Closure $next): Response
    {
        try {
            $this->openApiValidator->validateRequest($request);
        } catch (OpenApiValidatorException $exception) {
            return new JsonResponse(
                ['message' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return $next($request);
    }
}
