<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCustomerProfileRequest extends FormRequest
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
            'first_name' => 'required',
            'surname' => 'required',
            'birthdate' => 'required|date',
            'email' => 'email:dns',
            'phone' => 'nullable',
            'photo' => 'nullable',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => $this->name,
        ]);
    }
}
