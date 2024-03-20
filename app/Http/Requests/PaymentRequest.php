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
            'items' => 'required|array',
            'items.*.name' => 'required',
            'items.*.price' => 'required|numeric',
            'items.*.currency' => 'required|in:EUR,todo', //todo doplnit meny
        ];
    }
}
