<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BedRequest extends FormRequest
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
     * validation rules for storing a bed
     * @return string[]
     */
    public function store(): array
    {
        return [
            'ward_id'   => 'required|exists:wards,id',
            'name'      => 'required|alpha_num|min:2|max:20|unique:beds,name'
        ];

    }

    /**
     * validation rules for updating a bed
     * @return string[]
     */
    public function update(): array
    {
        return [
            'ward_id'   => 'required|exists:wards,id',
            'name'      => 'required|alpha_num|min:2|max:20|unique:beds,name,' . $this->bed_id
        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'ward_id.required'  => 'Select the ward the bed belongs to ',
            'ward_id.exists'    => 'Ward does nto exist',
            'name.required'     => 'Enter the bed\'s name',
            'name.alpha_num'    => 'Bed\'s name must have alpha numeric characters',
            'name.min'          => 'Bed\'s name must have at least three(3) alpha numeric characters',
            'name.max'          => 'Bed\'s name must not have more than twenty(20) alpha numeric characters',
            'name.unique'       => 'Bed name already exists'
        ];

    }

}
