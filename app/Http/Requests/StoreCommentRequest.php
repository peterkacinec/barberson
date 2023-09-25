<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'text' => 'required',
            'rating' => 'required|integer|between:1,5',
            'providerId' => 'required|numeric',
            'customerId' => 'required|numeric',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'provider_id' => $this->providerId,
            'customer_id' => $this->customerId,
        ]);
    }
}
