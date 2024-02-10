<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderListResource extends JsonResource
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
            'name' => $this->company->title,
            'priceStarter' => $this->cheapestService->price,
            'averageRating' => $this->comments_rating, // calculated field 'withAverage' laravel feature
            'description' => $this->description,
        ];
    }
}
