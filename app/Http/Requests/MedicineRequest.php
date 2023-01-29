<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
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
     * validation rules for storing a medicine
     * @return string[]
     */
    public function store(): array
    {
        return [
            'measurement_unit_id'   => 'required|exists:measurement_units,id',
            'name'                  => 'required|min:5|max:60|unique:medicines,name',
        ];

    }

    /**
     * validation rules for updating a medicine
     * @return string[]
     */
    public function update(): array
    {
        return [
            'measurement_unit_id'   => 'required|exists:measurement_units,id',
            'name'                  => 'required|min:5|max:60|unique:medicines,name,' . $this->medicine_id,
        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'measurement_unit_id.required'  => 'Select the measurement unit used for the medicine',
            'measurement_unit_id.exists'    => 'Measurement unit does not exist',
            'name.required'                 => 'Enter the medicine\'s name',
            'name.min'                      => 'Medicine\'s name must have at least five(5) characters',
            'name.max'                      => 'Medicine\'s name must not have more than sixty(60) characters',
            'name.unique'                   => 'Medicine name already exists'
        ];

    }

}
