<?php

namespace App\Actions\Fortify;

use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    use ProfileValidationRules;

    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function update(User $user, array $input): void
    {
        $input['mobile'] = $this->normalizeMobile($input['mobile'] ?? null);

        Validator::make($input, $this->profileRules($user->id))
            ->validateWithBag('updateProfileInformation');

        $attributes = [
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
        ];

        // A changed mobile number must be verified again.
        if ($input['mobile'] !== $user->mobile) {
            $attributes['mobile_verified_at'] = null;
        }

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $user->forceFill([...$attributes, 'email_verified_at' => null])->save();

            $user->sendEmailVerificationNotification();

            return;
        }

        $user->forceFill($attributes)->save();
    }
}
