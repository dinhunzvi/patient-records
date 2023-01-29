<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionRequest extends FormRequest
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
            'patient_id'        => 'required|exists:patients,id',
            'prescription_date' => 'required|date'
        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'patient_id.required'           => 'Select patient',
            'patient_id.exists'             => 'Patient not found',
            'prescription_date.required'    => 'Prescription date is required',
            'prescription_date.date'        => 'Prescription date must be a valid date'
        ];

    }

}
