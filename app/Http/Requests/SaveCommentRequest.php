<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCommentRequest extends FormRequest
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
            'text' => 'required',
            'rating' => 'required|integer|between:1,5',
            'provider_id' => 'required|numeric',
            'customer_id' => 'required|numeric',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'provider_id' => $this->providerId,
            'customer_id' => $this->customerId,
        ]);
    }
}
