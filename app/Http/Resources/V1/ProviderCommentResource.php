<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->text,
            'rating' => $this->rating,
            'customerId' => $this->customer_id,
            'authorName' => 'todo',
//            'customerPhotoUrl' => $this->customer->photo, //todo problem with lazy loading
            'createdAt' => $this->created_at,
        ];
    }
}
