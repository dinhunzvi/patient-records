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
        return [
            'patient_id'    => 'required|exists:patients,id',
            'visit_date'    => 'required|date',
            'symptoms'      => 'required',
            'diagnosis'     => 'required'
        ];

    }

}
