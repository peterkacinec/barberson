<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrderCollection;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $filter = new OrderFilter();
        $queryItems = $filter->transform($request);

        if ($queryItems === []) {
            $resource = new OrderCollection(Order::with('orderItems')->get());
        } else {
            $customers = Order::where($queryItems)->paginate();

            $resource = new OrderCollection($customers->appends($request->query()));
        }

        return $this->openApiValidator->validateResponse($request, $resource->response());
    }
}
