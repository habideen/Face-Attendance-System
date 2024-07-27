<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidAcademicSession implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the value matches the format YYYY/YYYY
        if (!preg_match('/^\d{4}\/\d{4}$/', $value)) {
            $fail('The :attribute must be in the format YYYY/YYYY.');
            return;
        }

        list($year1, $year2) = explode('/', $value);

        // Check if the first year is one less than the second year
        if (((int)$year2 - (int)$year1) !== 1) {
            $fail('The :attribute must have the second year one more than the first year.');
        }
    }
}
