<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'date' => 'required|date_format:Y-m-d',
            'price' => 'required|numeric',
            'status' => 'required',
            'payment_type' => 'required',
            'provider_id' => 'required|numeric',
            'customer_id' => 'required|numeric',
            'customer_address' => 'required',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'payment_type' => $this->paymentType,
            'provider_id' => $this->providerId,
            'customer_id' => $this->customerId,
            'customer_address' => $this->customerAddress,
        ]);
    }
}
