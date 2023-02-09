<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientAdmissionRequest extends FormRequest
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
     * validation rules for storing a patient admission
     * @return string[]
     */
    public function store(): array
    {
        return [
            'patient_id'        => 'required|exists:patients,id',
            'ward_id'           => 'required|exists:wards,id',
            'bed_id'            => 'required|exists:beds,id',
            'admission_date'    => 'required|date',
            'discharge_date'    => 'date|nullable',

        ];

    }

    /**
     * validation rules for updating a patient admission
     * @return string[]
     */
    public function update(): array
    {
        return [
            'patient_id'        => 'required|exists:patients,id',
            'ward_id'           => 'required|exists:wards,id',
            'bed_id'            => 'required|exists:beds,id',
            'admission_date'    => 'required|date',
            'discharge_date'    => 'date|nullable',

        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'patient_id.required'       => 'Select the patient',
            'patient_id.exists'         => 'Patient not found',
            'ward_id.required'          => 'Select ward patient will be admitted in',
            'ward_id.exists'            => 'Ward not found',
            'bed_id.required'           => 'Select bed patient will be admitted',
            'bed_id.exists'             => 'Bed not found',
            'admission_date.required'   => 'Select date patient was admitted',
            'admission_date.date'       => 'Admission date is not a valid date',
            'discharge_date.date'       => 'Discharge date is not a valid date'
        ];

    }

}
