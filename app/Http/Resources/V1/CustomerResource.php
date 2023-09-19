<?php

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
            'name' => $this->name,
            'surname' => $this->surname,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'photo' => $this->photo,
        ];
    }
}
