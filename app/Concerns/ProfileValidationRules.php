<?php

namespace App\Concerns;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

trait ProfileValidationRules
{
    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, Unique|ValidationRule|array<mixed>|string>>
     */
    protected function profileRules(?int $userId = null): array
    {
        return [
            'first_name' => $this->nameRules(),
            'last_name' => $this->nameRules(),
            'email' => $this->emailRules($userId),
            'mobile' => $this->mobileRules($userId),
        ];
    }

    /**
     * Get the validation rules used to validate user names.
     *
     * @return array<int, Unique|ValidationRule|array<mixed>|string>
     */
    protected function nameRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rules used to validate user emails.
     *
     * @return array<int, Unique|ValidationRule|array<mixed>|string>
     */
    protected function emailRules(?int $userId = null): array
    {
        return [
            'required',
            'string',
            'email',
            'max:255',
            $userId === null
                ? Rule::unique(User::class)
                : Rule::unique(User::class)->ignore($userId),
        ];
    }

    /**
     * Get the validation rules used to validate user mobile numbers.
     *
     * Numbers are expected in normalized E.164-like form (see normalizeMobile()).
     *
     * @return array<int, Unique|ValidationRule|array<mixed>|string>
     */
    protected function mobileRules(?int $userId = null): array
    {
        return [
            'nullable',
            'string',
            'regex:/^\+?[1-9]\d{6,14}$/',
            $userId === null
                ? Rule::unique(User::class)
                : Rule::unique(User::class)->ignore($userId),
        ];
    }

    /**
     * Strip formatting characters (spaces, dashes, brackets, dots) from a mobile number.
     */
    protected function normalizeMobile(?string $mobile): ?string
    {
        $normalized = preg_replace('/[^\d+]/', '', (string) $mobile);

        return $normalized === '' ? null : $normalized;
    }
}
