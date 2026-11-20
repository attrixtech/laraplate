<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $input['mobile'] = $this->normalizeMobile($input['mobile'] ?? null);

        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
        ], [
            'mobile.regex' => __('Please enter a valid mobile number, including the country code.'),
        ])->validate();

        return User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'password' => $input['password'],
        ]);
    }
}
