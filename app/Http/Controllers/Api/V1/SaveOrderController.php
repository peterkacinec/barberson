<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveOrderRequest;
use App\Services\SaveOrderService;
use Illuminate\Http\JsonResponse;

class SaveOrderController extends Controller
{
    public function __construct(private SaveOrderService $saveOrderService)
    {
    }

    public function __invoke(SaveOrderRequest $request): JsonResponse
    {
        $this->saveOrderService->__invoke($request->validated());

        return new JsonResponse(true);
    }
}
