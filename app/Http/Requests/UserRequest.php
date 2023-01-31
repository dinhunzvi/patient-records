<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
     * validation rules for storing a user
     * @return string[]
     */
    public function store(): array
    {
        return [
            'name'                  => 'required|min:5|max:100',
            'email'                 => 'required|email|unique:users,email',
            'password'              => [ 'required', Password::defaults(), 'confirmed' ],
            'password_confirmation' => 'required|min:8'
        ];

    }

    /**
     * validation rules for updating a user
     * @return string[]
     */
    public function update(): array
    {
        return [
            'name'      => 'required|min:5|max:100',
            'email'     => 'required|email|unique:users,email,' . $this->user_id,
        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'Enter the user\'s name',
            'name.min'          => 'User\'s name must have at least five(5) letters',
            'name.max'          => 'User\'s name must not have more than one hundred(100) characters',
            'email.required'    => 'Enter user\'s email address',
            'email.email'       => 'Email address is not valid',
            'email.unique'      => 'Email address already taken',
            'password.required' => 'Enter user\'s password',
            'password.Password::defaults'   => 'Password must have digits, and special characters',
            'password.confirmed'    => 'Confirm user\'s password',
            'password_confirmation.required'    => 'Confirm user\'s password'
        ];

    }

}
