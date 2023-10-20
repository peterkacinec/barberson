<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => $this->date,
            'totalPrice' => $this->price,
            'status' => $this->status,
            'selectedServices' => OrderItemResource::collection($this->orderItems),
//            'selectedServices' => OrderItemResource::collection($this->whenLoaded('orderItems')), //todo
            'paymentType' => $this->payment_type,
            'location' => $this->customer_address,
        ];
    }
}
