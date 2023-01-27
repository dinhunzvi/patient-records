<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WardRequest extends FormRequest
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
     * validation rules for storing a ward
     * @return string[]
     */
    public function store(): array
    {
        return [
            'name'      => 'required|unique:wards,name'
        ];

    }

    /**
     * validation rules for updating a ward
     * @return string[]
     */
    public function update(): array
    {
        return [
            'name'      => 'required|unique:wards,name,' . $this->ward_id
        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Enter the ward\'s name',
            'name.unique'   => 'Ward\'s name already taken'
        ];

    }

}
