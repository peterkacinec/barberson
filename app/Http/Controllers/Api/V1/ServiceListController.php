<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ServiceCollection;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceListController extends Controller
{
    public function __invoke(Request $request, Provider $provider): JsonResponse
    {
        $resource = new ServiceCollection($provider->services);

        return $this->openApiValidator->validateResponse($request, $resource->response());
    }
}
