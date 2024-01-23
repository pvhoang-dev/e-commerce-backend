<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVariantDiscountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->status == null ? 0 : 1,
            'start_date' => $this->start_date ?? 0,
            'end_date' => $this->end_date ?? 0,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'discount_percent'  => [
                'required',
                'numeric',
                'min:1',
                'max:100'
            ]
        ];
    }
}
