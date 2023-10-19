<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderSaveController extends Controller
{
    public function __invoke(StoreOrderRequest $request): JsonResource
    {
        return new OrderResource(Order::create($request->validated()));
    }
}
