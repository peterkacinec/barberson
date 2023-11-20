<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        Str::orderedUuid()->toString(); todo

        return [
            'id' => $this->id,
            'name' => $this->user->first_name,
            'surname' => $this->user->surname,
            'birthdate' => $this->user->birthdate,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'state' => $this->state,
            'photo' => $this->photo,
        ];
    }
}
