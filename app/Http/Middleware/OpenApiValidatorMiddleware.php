<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Common\Application\OpenApiValidatorInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OpenApiValidatorMiddleware
{
    public function __construct(private OpenApiValidatorInterface $openApiValidator)
    {}

    public function handle(Request $request, Closure $next): Response
    {
        $this->openApiValidator->validateRequest($request);

        return $next($request);
    }
}
