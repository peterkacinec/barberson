<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailController extends Controller
{
    public function __invoke(Order $order): JsonResource
    {
        return new OrderResource($order);
    }
}
