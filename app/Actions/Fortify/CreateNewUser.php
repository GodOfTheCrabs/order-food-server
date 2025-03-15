<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
    public function create(array $input): User
    {
        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'phone' => [
                'required',
                'regex:/^\+380 \d{2}-\d{3}-\d{2}-\d{2}$/',
                'unique:users,phone',
            ],
            'password' => $this->passwordRules(),
            'roles' => [
                'required', 
                'array',    
                'exists:roles,id', 
            ],
        ])->validate();

        $user = User::create([
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->roles()->attach($input['roles']);

        return $user;
    }
}
