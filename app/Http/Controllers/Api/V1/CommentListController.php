<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Common\Infrastructure\OpenApi\OpenApiValidatorException;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CommentCollection;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CommentListController extends Controller
{
    public function __invoke(Request $request, Provider $provider): JsonResponse
    {
        $resource = new CommentCollection($provider->comments()->with(['customer', 'customer.user'])->get());

        try {
            return $this->openApiValidator->validateResponse($request, $resource->response());
        } catch (OpenApiValidatorException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
