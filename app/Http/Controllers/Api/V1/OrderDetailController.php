<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderDetailController extends Controller
{
    public function __invoke(Order $order): JsonResponse
    {
        return (new OrderResource($order))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
