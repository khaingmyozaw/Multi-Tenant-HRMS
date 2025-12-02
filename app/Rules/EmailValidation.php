<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class EmailValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $fail("The provided :attrubute must be a valid email.");
        }

        $isUser = User::where('email', $value)->exists();
        if (! $isUser) {
            $fail("The provided credentials doesn't match with our records.");
        }
    }
}
