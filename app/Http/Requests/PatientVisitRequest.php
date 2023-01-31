<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientVisitRequest extends FormRequest
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
        return $this->isMethod( 'POST' ) ? $this->store() : $this->update();

    }

    /**
     * validation rules for storing patient visit
     * @return string[]
     */
    public function store(): array
    {
        return [
            'patient_id'    => 'required|exists:patients,id',
            'visit_date'    => 'required|date',
            'symptoms'      => 'required',
            'diagnosis'     => 'required'
        ];
    }

    /**
     * validation rules for updating patient visit
     * @return string[]
     */
    public function update(): array
    {
        return [
            'patient_id'    => 'required|exists:patients,id',
            'visit_date'    => 'required|date',
            'symptoms'      => 'required',
            'diagnosis'     => 'required'
        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'patient_id.required'   => 'Select patient',
            'patient_id.exists'     => 'Patient not found',
            'visit_date.required'   => 'Select patient visit date',
            'visit_date.date'       => 'Patient visit date is not a valid date',
            'symptoms.required'     => 'Enter the patient\'s symptoms',
            'diagnosis.required'    => 'Enter diagnosis of patient\'s symptoms',
        ];

    }

}
