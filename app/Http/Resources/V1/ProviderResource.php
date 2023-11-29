<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
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
            'ico' => $this->company->ico,
            'vat' => $this->company->vat,
            'iban' => $this->company->iban,
            'email' => $this->company->email,
            'phone' => $this->company->phone,
            'description' => $this->description,
            'service' => 'todo',
            'comments' => 'todo',
            'location' => 'todo',
            'workingDays' => 'todo',
            'availableTimes' => 'todo',
            'rating' => 'todo',
            'priceStarter' => 'todo'
        ];
    }
}
