<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeasurementUnitRequest extends FormRequest
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
    public function rules()
    {
        return $this->isMethod( 'POST' ) ? $this->store() : $this->update();

    }

    /**
     * validation rules for storing a measurement unit
     * @return string[]
     */
    public function store(): array
    {
        return [
            'name'      => 'required|min:3|max:60|unique:measurement_units,name',
            'code'      => 'required|min:1|max:3|unique:measurement_units,code',
        ];

    }

    /**
     * validation rules for updating a measurement unit
     * @return string[]
     */
    public function update(): array
    {
        return [
            'name'      => 'required|min:3|max:60|unique:measurement_units,name,' . $this->measurement_unit_id,
            'code'      => 'required|min:1|max:3|unique:measurement_units,code,' . $this->measurement_unit_id,
        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Enter the measurement unit\'s name',
            'name.min'      => 'Measurement unit\'s name must have at least three(3) characters',
            'name.max'      => 'Measurement unit\'s name must not have more than sixty(60) characters',
            'name.unique'   => 'Measurement unit name already exists',
            'code.required' => 'Enter the measurement unit\'s code',
            'code.min'      => 'Measurement unit\'s code must have at least one(1) characters',
            'code.max'      => 'Measurement unit\'s code must not have more than three(3) characters',
            'code.unique'   => 'Measurement unit code already exists',
        ];

    }

}
