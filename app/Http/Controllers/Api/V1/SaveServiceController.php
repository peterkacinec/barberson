<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveServiceRequest;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class SaveServiceController extends Controller
{
    public function __invoke(SaveServiceRequest $request): JsonResponse
    {
        Service::create(
            [
                ...$request->validated(),
                'currency' => 'EUR',
            ]
        );

        return new JsonResponse(true);
    }
}
