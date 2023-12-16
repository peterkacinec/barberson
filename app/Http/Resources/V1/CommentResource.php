<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'message' => $this->text,
            'rating' => $this->rating,
            'customerId' => $this->customer_id,
            'authorName' => 'todo',
            'src' => $this->customer->photo, //todo, zly nazov src. customerPhotoUrl
            'providerId' => $this->provider_id,
            'createdAt' => $this->created_at,
        ];
    }
}
