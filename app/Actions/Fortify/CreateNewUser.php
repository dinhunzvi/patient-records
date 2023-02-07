<?php

namespace App\Actions\Fortify;

use App\Http\Resources\UserResource;
use App\Mail\UserRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): UserResource
    {

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make( $input['password']),
        ]);

        Mail::to( $user->email )->send( new UserRegistration( $user->email, $user->name, $input['password'] ) );

        return new UserResource( $user );

    }

}
