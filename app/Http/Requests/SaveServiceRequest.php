<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'provider_id' => 'required|numeric',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'provider_id' => $this->providerId,
        ]);
    }
}
