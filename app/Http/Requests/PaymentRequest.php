<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'paymentItems' => 'required|array',
            'paymentItems.*.name' => 'required',
            'paymentItems.*.price' => 'required|numeric',
            'paymentItems.*.currency' => 'required|in:EUR,todo', //todo doplnit meny
        ];
    }
}
