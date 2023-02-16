<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'medicine_id'   => 'required|exists:medicines,id',
            'quantity'      => 'required|integer|min:1',
            'dosage'        => 'required'
        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'medicine_id.required'  => 'Select prescribed medicine',
            'medicine_id.exists'    => 'Medicine not found',
            'quantity.required'     => 'Enter quantity prescribed',
            'quantity.integer'      => 'Quantity must be a whole number',
            'quantity.min'          => 'Quantity must be at least 1',
            'dosage.required'       => 'Enter the prescribed dosage'
        ];

    }

}
